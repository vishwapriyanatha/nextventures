<?php

namespace App\Contracts\Services;

use App\Models\Order;

interface OrderServiceInterface
{
    public function finalize(Order $order): void;

    public function rollback(Order $order, string $reason = null): void;

}
