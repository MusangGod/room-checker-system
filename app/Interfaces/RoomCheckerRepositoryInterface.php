<?php

namespace App\Interfaces;


// Interface: Menyediakan kontrak atau blueprint yang harus diikuti oleh kelas yang mengimplementasikannya.
use App\Models\RoomChecker;

interface RoomCheckerRepositoryInterface
{
    // Mendeklarasikan fungsi untuk mendapatkan semua tag
    public function getAll();

    // Mendeklarasikan fungsi untuk mendapatkan tag berdasarkan ID
    public function getByRoomId($roomId);

    // Mendeklarasikan fungsi untuk mendapatkan tag berdasarkan ID
    public function getById($id);

    // Mendeklarasikan fungsi untuk menyimpan tag baru
    public function store(array $data);

    // Mendeklarasikan fungsi untuk memperbarui tag berdasarkan ID
    public function update(array $data, RoomChecker $roomCategory);

    // Mendeklarasikan fungsi untuk menghapus tag berdasarkan ID
    public function delete($id);
}

