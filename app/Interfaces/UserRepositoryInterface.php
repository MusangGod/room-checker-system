<?php

namespace App\Interfaces;

use App\Models\User;

// Interface: Menyediakan kontrak atau blueprint yang harus diikuti oleh kelas yang mengimplementasikannya.
interface UserRepositoryInterface
{
    // Mendeklarasikan fungsi untuk mengambil data super admin berdasarkan user id
    public function getSuperAdminByUserID(string $userID);
    // Mendeklarasikan fungsi untuk mengambil data admin berdasarkan user id
    public function getAdminByUserID(string $userID);
    // Mendeklarasikan fungsi untuk mengambil data staff berdasarkan user id
    public function getStaffByUserID(string $userID);
    // Mendeklarasikan fungsi untuk memperbarui user
    public function update(array $data);
}

