<?php

namespace App\Repositories\Interfaces;

interface BarangRepositoryInterface
{
    public function getAll();

    public function getById($id);
}
