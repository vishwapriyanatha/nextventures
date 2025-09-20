<?php

namespace App\Repositories;

use App\Contracts\Repositories\StockRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Stock;

class StockRepository extends BaseRepository implements StockRepositoryInterface
{
    protected $entity;

    public function __construct(
        Stock $stock,
    )
    {
        $this->entity = $stock;
    }

    /**
     * @param int $itemID
     * @return bool
     */
    public function reserveStock(int $itemID): bool {
        $oldestStock = $this->entity
            ->where('item_id', $itemID)
            ->where('count', '!=', 0)
            ->oldest('created_at')
            ->first();

        if ($oldestStock) {
            $oldestStock->count -= 1;
            $oldestStock->save();

            return true;
        }

        return false;
    }

}
