<?php
// app/Repositories/Eloquent/PenggunaRepository.php

namespace App\Repositories\Eloquent;

use App\Models\Pengguna;
use App\Repositories\Interfaces\PenggunaRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class PenggunaRepository implements PenggunaRepositoryInterface
{
    public function all()
    {
        return Pengguna::all();
    }

    public function create(array $attributes)
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return Pengguna::create($attributes);
    }
}
