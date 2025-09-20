<?php

namespace App\Jobs;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Contracts\Services\OrderServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaymentCallbackJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $orderId;
    public string $status; // 'success'|'failure'
    public $tries = 3;

    public function __construct(int $orderId, string $status)
    {
        $this->orderId = $orderId;
        $this->status = $status;
    }

    /**
     * @return void
     */
    public function handle()
    {
        $orderRepo = app(OrderRepositoryInterface::class);
        $order = $orderRepo->find($this->orderId);

        $orderService = app(OrderServiceInterface::class);

        if ($this->status === 'success') {
            // finalize
            $orderService->finalize($order, ['gateway' => 'simulator']);
        } else {
            // rollback
            $orderService->rollback($order, 'payment_failed');
        }
    }
}
