<?php
namespace App\Events;
use App\Models\Order;
class OrderProcessed {
    public function __construct(public Order $order) {}
}
