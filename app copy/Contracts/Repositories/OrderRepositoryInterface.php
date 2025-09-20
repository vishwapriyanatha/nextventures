<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseServiceInterface;

interface OrderRepositoryInterface extends BaseServiceInterface
{
    public function getTodayOrderStatus(string $date);
}
