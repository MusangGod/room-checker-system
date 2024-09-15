<?php

namespace App\Repositories;

use App\Interfaces\StaffRepositoryInterface;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class StaffRepository implements StaffRepositoryInterface
{
    // Fungsi untuk mendapatkan semua data staff
    public function getAll(): Collection
    {
        // Mengambil semua staff dan mengurutkannya dari yang terbaru
        return Staff::with(["user"])->latest()->get();
    }

    // Fungsi untuk mendapatkan data staff berdasarkan ID
    public function getById($id): Staff
    {
        // Mencari staff berdasarkan ID, atau gagal jika tidak ditemukan
        return Staff::findOrFail($id);
    }

    // Fungsi untuk menyimpan data staff baru
    public function store(array $data): Staff
    {
        User::create(Arr::except($data, ['name', 'staff_number']));
        $user = User::where('username', $data['username'])->first();
        $data["user_id"] = $user->id;
        // Membuat staff baru dengan data yang diberikan
        return Staff::create(Arr::only($data, ['user_id', 'name', 'staff_number']));
    }

    // Fungsi untuk mengupdate data staff yang ada
    public function update(array $newData, Staff $staff): Staff
    {
        User::whereId($staff->user_id)->update(Arr::except($newData, 'name'));
        // Mengupdate staff berdasarkan ID dengan data baru yang diberikan
        $is_updated = Staff::whereId($staff->id)->update(Arr::only($newData, ['name', 'user_id']));
        // Mengambil staff yang telah diperbarui
        $get_staff = $this->getById($staff->id);
        // Mengembalikan staff yang diperbarui jika berhasil, atau null jika gagal
        return $is_updated ? $get_staff : null;
    }

    // Fungsi untuk menghapus data staff
    public function delete($id): Staff
    {
        // Mengambil staff berdasarkan ID sebelum dihapus
        $get_staff = $this->getById($id);
        User::find($get_staff->user_id)->delete();
        // Menghapus staff berdasarkan ID
        $is_deleted = Staff::destroy($id);
        // Mengembalikan staff yang dihapus jika berhasil, atau null jika gagal
        return $is_deleted ? $get_staff : null;
    }
}
