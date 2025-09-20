<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseServiceInterface;

interface ItemRepositoryInterface extends BaseServiceInterface
{
    public function getItemByItemID(string $itemID);

}
