<?php
namespace App\Services;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Contracts\Services\KpiServiceInterface;
use App\Core\BaseAppService;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class KpiService extends BaseAppService implements KpiServiceInterface
{
    /**
     * @var OrderRepositoryInterface
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
     * @return void
     */
    public function generateDailyKPIs()
    {
        $today = Carbon::today()->toDateString();

        $stats = $this->orderRepository->getTodayOrderStatus($today);

        Redis::hmset("kpis:{$today}", [
            'revenue' => $stats->revenue ?? 0,
            'order_count' => $stats->order_count ?? 0,
            'average_order_value' => $stats->average_order_value ?? 0,
        ]);
    }

    /**
     * @param $date
     * @return mixed
     */
    public function getDailyKPIs($date = null)
    {
        $date = $date ?? Carbon::today()->toDateString();
        return Redis::hgetall("kpis:{$date}");
    }
}
