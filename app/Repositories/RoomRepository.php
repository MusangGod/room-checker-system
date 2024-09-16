<?php

namespace App\Repositories;

use App\Interfaces\RoomRepositoryInterface;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;

class RoomRepository implements RoomRepositoryInterface
{
    // Fungsi untuk mendapatkan semua data Tag
    public function getAll(): Collection
    {
        // Mengambil semua tag dan mengurutkannya dari yang terbaru
        return Room::with('room_category')->latest()->get();
    }

    // Fungsi untuk mendapatkan data Tag berdasarkan ID
    public function getById($id): Room
    {
        // Mencari tag berdasarkan ID, atau gagal jika tidak ditemukan
        return Room::findOrFail($id);
    }

    // Fungsi untuk menyimpan data Tag baru
    public function store(array $data): Room
    {
        // Membuat tag baru dengan data yang diberikan
        return Room::create($data);
    }

    // Fungsi untuk mengupdate data Tag yang ada
    public function update(array $newData, Room $room): ?Room
    {
        // Mengupdate tag berdasarkan ID dengan data baru yang diberikan
        $is_updated = Room::whereId($room->id)->update($newData);
        // Mengambil tag yang telah diperbarui
        $get_room = $this->getById($room->id);
        // Mengembalikan tag yang diperbarui jika berhasil, atau null jika gagal
        return $is_updated ? $get_room : null;
    }

    // Fungsi untuk menghapus data Tag
    public function delete($id): ?Room
    {
        // Mengambil tag berdasarkan ID sebelum dihapus
        $get_room = $this->getById($id);
        // Menghapus tag berdasarkan ID
        $is_deleted = Room::destroy($id);
        // Mengembalikan tag yang dihapus jika berhasil, atau null jika gagal
        return $is_deleted ? $get_room : null;
    }
}

