<?php

namespace App\Repositories;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * @var Order
     */
    protected $entity;

    /**
     * @param Order $order
     */
    public function __construct(
        Order $order,
    )
    {
        $this->entity = $order;
    }

    /**
     * @param string $date
     * @return mixed
     */
    public function getTodayOrderStatus(string $date)
    {
        return $this->entity
            ->selectRaw('
                SUM(total) as revenue,
                COUNT(*) as order_count,
                AVG(total) as average_order_value
            ')
            ->whereDate('created_at', $date)
            ->first();
    }

}
