<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Admin;
use App\Models\PostTag;
use App\Models\Staff;
use App\Models\SuperAdmin;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class UserRepository implements UserRepositoryInterface
{
    public function getSuperAdminByUserID(string $userID)
    {
        return SuperAdmin::with('user')->where('user_id', $userID)->first();
    }

    public function getAdminByUserID(string $userID)
    {
        return Admin::with('user')->where('user_id', $userID)->first();
    }

    public function getStaffByUserID(string $userID)
    {
        return Staff::with('user')->where('user_id', $userID)->first();
    }

    // Fungsi untuk mengupdate data User yang ada
    public function update(array $newData): User
    {
        $user = User::find(auth()->id());
        // Mengupdate user berdasarkan ID dengan data baru yang diberikan
        $is_updated = $user->update(Arr::except($newData, 'name'));

        if($user->role == Role::SUPER_ADMIN) {
            SuperAdmin::where('user_id', $user->id)->update(Arr::only($newData, 'name'));
        } else if($user->role == Role::ADMIN) {
            Admin::where('user_id', $user->id)->update(Arr::only($newData, 'name'));
        } else {
            Staff::where('user_id', $user->id)->update(Arr::only($newData, 'name'));
        }

        // Mengembalikan user yang diperbarui jika berhasil, atau null jika gagal
        return $is_updated ? auth()->user() : null;
    }
}
