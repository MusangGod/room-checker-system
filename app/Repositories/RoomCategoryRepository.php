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
    // Fungsi untuk mendapatkan semua data Tag
    public function getAll(): Collection
    {
        // Mengambil semua tag dan mengurutkannya dari yang terbaru
        return RoomCategory::latest()->get();
    }

    // Fungsi untuk mendapatkan data Tag berdasarkan ID
    public function getById($id): RoomCategory
    {
        // Mencari tag berdasarkan ID, atau gagal jika tidak ditemukan
        return RoomCategory::findOrFail($id);
    }

    // Fungsi untuk menyimpan data Tag baru
    public function store(array $data): RoomCategory
    {
        // Membuat tag baru dengan data yang diberikan
        return RoomCategory::create($data);
    }

    // Fungsi untuk mengupdate data Tag yang ada
    public function update(array $newData, RoomCategory $roomCategory): ?RoomCategory
    {
        // Mengupdate tag berdasarkan ID dengan data baru yang diberikan
        $is_updated = RoomCategory::whereId($roomCategory->id)->update($newData);
        // Mengambil tag yang telah diperbarui
        $get_roomCategory = $this->getById($roomCategory->id);
        // Mengembalikan tag yang diperbarui jika berhasil, atau null jika gagal
        return $is_updated ? $get_roomCategory : null;
    }

    // Fungsi untuk menghapus data Tag
    public function delete($id): ?RoomCategory
    {
        $get_roomCategory = $this->getById($id);
        // Menghapus tag berdasarkan ID
        $is_deleted = RoomCategory::destroy($id);
        // Mengembalikan tag yang dihapus jika berhasil, atau null jika gagal
        return $is_deleted ? $get_roomCategory : null;
    }
}

