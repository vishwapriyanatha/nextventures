<?php
namespace App\Listeners;
use App\Jobs\SendOrderNotification;
use App\Events\OrderProcessed;

class QueueOrderNotification
{
    public function handle(OrderProcessed $event)
    {
        SendOrderNotification::dispatch($event->order->id, 'success')->onQueue('notifications');
    }
}
