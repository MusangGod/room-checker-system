<?php

namespace App\Repositories;

use App\Interfaces\RoomCategoryRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Models\PostTag;
use App\Models\RoomCategory;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class RoomCategoryRepository implements RoomCategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return RoomCategory::latest()->get();
    }

    public function getById($id): RoomCategory
    {
        return RoomCategory::findOrFail($id);
    }

    public function store(array $data): RoomCategory
    {
        return RoomCategory::create($data);
    }

    public function update(array $newData, RoomCategory $roomCategory): ?RoomCategory
    {
        $is_updated = RoomCategory::whereId($roomCategory->id)->update($newData);
        $get_roomCategory = $this->getById($roomCategory->id);
        return $is_updated ? $get_roomCategory : null;
    }

    public function delete($id): ?RoomCategory
    {
        $get_roomCategory = $this->getById($id);
        $is_deleted = RoomCategory::destroy($id);
        return $is_deleted ? $get_roomCategory : null;
    }
}

