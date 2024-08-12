<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class AdminRepository implements AdminRepositoryInterface
{
    // Fungsi untuk mendapatkan semua data admin
    public function getAll(): Collection
    {
        // Mengambil semua admin dan mengurutkannya dari yang terbaru
        return Admin::with(["user"])->latest()->get();
    }

    // Fungsi untuk mendapatkan data admin berdasarkan ID
    public function getById($id): Admin
    {
        // Mencari admin berdasarkan ID, atau gagal jika tidak ditemukan
        return Admin::with(['user'])->findOrFail($id);
    }

    // Fungsi untuk menyimpan data admin baru
    public function store(array $data): Admin
    {
        User::create(Arr::except($data, 'name'));
        $user = User::where('username', $data['username'])->first();
        $data["user_id"] = $user->id;
        // Membuat admin baru dengan data yang diberikan
        return Admin::create(Arr::only($data, ['user_id', 'name']));
    }

    // Fungsi untuk mengupdate data admin yang ada
    public function update(array $newData, $admin): Admin
    {
        User::whereId($admin->user_id)->update(Arr::except($newData, 'name'));
        // Mengupdate admin berdasarkan ID dengan data baru yang diberikan
        $is_updated = Admin::whereId($admin->id)->update(Arr::only($newData, ['user_id', 'name']));
        // Mengambil admin yang telah diperbarui
        $get_admin = $this->getById($admin->id);
        // Mengembalikan admin yang diperbarui jika berhasil, atau null jika gagal
        return $is_updated ? $get_admin : null;
    }

    // Fungsi untuk menghapus data admin
    public function delete($id): Admin
    {
        // Mengambil admin berdasarkan ID sebelum dihapus
        $get_admin = $this->getById($id);
        User::find($get_admin->user_id)->delete();
        // Menghapus admin berdasarkan ID
        $is_deleted = Admin::destroy($id);
        // Mengembalikan admin yang dihapus jika berhasil, atau null jika gagal
        return $is_deleted ? $get_admin : null;
    }
}
