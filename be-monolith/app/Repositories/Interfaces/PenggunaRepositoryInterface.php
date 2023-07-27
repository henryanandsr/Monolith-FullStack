<?php
// app/Repositories/Interfaces/PenggunaRepositoryInterface.php

namespace App\Repositories\Interfaces;

use App\Models\Pengguna;

interface PenggunaRepositoryInterface
{
    public function all();

    public function create(array $attributes);
}
