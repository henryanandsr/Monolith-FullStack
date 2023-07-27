<?php

namespace App\Repositories\Eloquent;

use App\Models\Orders;
use App\Repositories\Interfaces\OrdersRepositoryInterface;

class OrdersRepository implements OrdersRepositoryInterface
{
    public function all()
    {
        return Orders::all();
    }

    public function getByUserId($userId)
    {
        return Orders::where('user_id', $userId)->paginate(10);
    }

    public function create(array $attributes)
    {
        return Orders::create($attributes);
    }
}
