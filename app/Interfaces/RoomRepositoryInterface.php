<?php

namespace App\Interfaces;

use App\Models\Room;

interface RoomRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function store(array $data);

    public function update(array $data, Room $roomCategory);

    public function delete($id);
}

