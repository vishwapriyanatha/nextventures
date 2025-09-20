<?php
namespace App\Jobs;
use App\Models\Order;
use App\Models\NotificationHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendOrderNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $orderId;
    protected string $status; // success|failed

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
        $order = Order::find($this->orderId);
        if (!$order) return;

        $payload = [
            'order_id' => $order->id,
            'customer_id' => $order->customer_id,
            'status' => $this->status,
            'total' => $order->total,
        ];

        Log::info('Order notification', $payload);

        NotificationHistory::create([
            'order_id' => $order->id,
            'customer_id' => $order->customer_id,
            'status' => $this->status,
            'total' => $order->total,
            'channel' => 'log',
            'payload' => $payload,
            'notified_at' => now(),
        ]);
    }
}
