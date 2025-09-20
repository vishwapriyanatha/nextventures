<?php

namespace App\Jobs;

use App\Services\OrderService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrderImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;

    protected array $row;

    public function __construct(array $row)
    {
        $this->row = $row;
    }

    /**
     * @param OrderService $orderService
     * @return void
     */
    public function handle(OrderService $orderService)
    {
        $order = $orderService->createFromImport($this->row);

        $orderService->startWorkflow($order);
    }
}
