<?php

namespace App\Interfaces;

use App\Models\RoomCategory;

interface RoomCategoryRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function store(array $data);

    public function update(array $data, RoomCategory $roomCategory);

    public function delete($id);
}

