<?php

namespace App\Jobs;

use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\StockRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReserveStockJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 60;
    public $tries = 3;

    protected string $itemId;

    public function __construct(string $itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return void
     */
    public function handle()
    {
        $item = app(ItemRepository::class)->getItemByItemID($this->itemId);

        if (!$item) return;


        $reserveStock = app(StockRepository::class)->reserveStock($item->id);

        $status = 'failure';
        if ($reserveStock) {
            $status = 'success';
        }

        $data = [
            'id' => $item->id,
            'status' => $status
        ];

        SimulatePaymentJob::dispatch($data);
    }
}
