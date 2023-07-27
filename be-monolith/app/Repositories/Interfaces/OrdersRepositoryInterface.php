<?php

namespace App\Repositories\Interfaces;

interface OrdersRepositoryInterface
{
    public function all();

    public function getByUserId($userId);

    public function create(array $attributes);
}
