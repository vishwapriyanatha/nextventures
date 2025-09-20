<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseServiceInterface;

interface StockRepositoryInterface extends BaseServiceInterface
{
    public function reserveStock(int $itemID): bool;
}
