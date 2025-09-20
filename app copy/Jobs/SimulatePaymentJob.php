<?php

namespace App\Jobs;

use App\Contracts\Repositories\OrderRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SimulatePaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $orderId;
    protected string $status;

    public $tries = 3;
    public $timeout = 120;

    public function __construct(array $data)
    {
        $this->orderId = $data['id'];
        $this->status = $data['status'];
    }

    /**
     * @return void
     */
    public function handle()
    {
        $delaySeconds = rand(1, 3);

        PaymentCallbackJob::dispatch($this->orderId, $this->status)
            ->delay(now()->addSeconds($delaySeconds));
    }
}
