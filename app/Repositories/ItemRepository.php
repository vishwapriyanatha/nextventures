<?php

namespace App\Repositories;

use App\Contracts\Repositories\ItemRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Item;

class ItemRepository extends BaseRepository implements ItemRepositoryInterface
{
    protected $entity;

    public function __construct(
        Item $item,
    )
    {
        $this->entity = $item;
    }

    /**
     * @param string $itemID
     * @return mixed
     */
    public function getItemByItemID(string $itemID)
    {
        return $this->entity->where('item_code', $itemID)->first();
    }
}
