<?php

namespace App\Services;

use App\Contracts\Services\OrderServiceInterface;
use App\Core\BaseAppService;
use App\Events\OrderFailed;
use App\Events\OrderProcessed;
use App\Models\Order;
use App\Jobs\ReserveStockJob;
use App\Contracts\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Facades\Redis;

class OrderService extends BaseAppService implements OrderServiceInterface
{
    /**
     * @var OrderRepositoryInterface|OrderRepository
     */
    protected $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
    )
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param array $data
     * @return Order
     */
    public function createFromImport(array $data): Order
    {
        return $this->orderRepository->create($data);
    }

    /**
     * @param Order $order
     * @return void
     */
    public function startWorkflow(Order $order): void
    {
        ReserveStockJob::dispatch($order->item_id);
    }

    /**
     * @param Order $order
     * @return void
     */
    public function finalize(Order $order): void
    {
        $this->orderRepository->update($order, [
            'status' => 'processed',
            'processed_at' => now(),
        ]);

        $this->updateKpisAndLeaderboard($order);
        event(new OrderProcessed($order));
    }

    /**
     * @param Order $order
     * @param string|null $reason
     * @return void
     */
    public function rollback(Order $order, string $reason = null): void
    {
        $this->orderRepository->update($order, [
            'status' => 'failed',
            'processed_at' => now(),
        ]);

        event(new OrderFailed($order, $reason));
    }

    /**
     * @param Order $order
     * @return void
     */
    protected function updateKpisAndLeaderboard(Order $order): void
    {
        $redis = redis();

        $dateKey = now()->format('Y-m-d');
        $kpiKey = "kpi:orders:{$dateKey}";

        $redis->pipeline(function ($pipe) use ($kpiKey, $order) {
            $pipe->hincrby($kpiKey, 'count', 1);
            $pipe->hincrbyfloat($kpiKey, 'revenue', $order->total);
            $pipe->expire($kpiKey, 60 * 60 * 24 * 31); // keep a month
            $pipe->zincrby('leaderboard:customers', $order->total, $order->customer_id);
        });
    }
}
