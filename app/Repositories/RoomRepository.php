<?php

namespace App\Repositories;

use App\Interfaces\RoomRepositoryInterface;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RoomRepository implements RoomRepositoryInterface
{
    public function getAll(): Collection
    {
        return Room::with('room_category', 'room_check')->latest()->get();
    }

    public function getById($id): Collection|\Illuminate\Database\Eloquent\Model
    {
        return Room::with('room_category')->findOrFail($id);
    }

    public function store(array $data): Room
    {
        return Room::create($data);
    }

    public function update(array $newData, Room $room): ?Room
    {
        $is_updated = Room::whereId($room->id)->update($newData);
        $get_room = $this->getById($room->id);
        return $is_updated ? $get_room : null;
    }

    public function delete($id): ?Room
    {
        $get_room = $this->getById($id);
        $is_deleted = Room::destroy($id);
        return $is_deleted ? $get_room : null;
    }
}

