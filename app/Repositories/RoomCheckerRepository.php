<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Interfaces\RoomCategoryRepositoryInterface;
use App\Interfaces\RoomCheckerRepositoryInterface;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomChecker;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class RoomCheckerRepository implements RoomCheckerRepositoryInterface
{
    // Fungsi untuk mendapatkan semua data Tag
    public function getAll(): Collection
    {
        // Mengambil semua tag dan mengurutkannya dari yang terbaru
        return RoomChecker::with('user_data', 'room_data')->latest()->get();
    }

    public function getByMonthAndYear($month, $year)
    {
        if (Auth::user()->role == Role::ADMIN) {
            if ($month !== null && $year == null) {
                $filteredData = RoomChecker::with('user_data', 'room_data')
                    ->whereMonth('date', $month)
                    ->latest()
                    ->get();
            } else if ($month !== null && $year !== null) {
                $filteredData = RoomChecker::with('user_data', 'room_data')
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->latest()
                    ->get();
            } else if ($month == null && $year != null) {
                $filteredData = RoomChecker::with('user_data', 'room_data')
                    ->whereYear('date', $year)
                    ->latest()
                    ->get();
            } else {
                $filteredData = $this->getAll();
            }
        } else {
            if ($month !== null && $year == null) {
                $filteredData = RoomChecker::with('user_data', 'room_data')
                    ->where('user_id', Auth::user()->id)
                    ->whereMonth('date', $month)
                    ->latest()
                    ->get();
            } else if ($month !== null && $year !== null) {
                $filteredData = RoomChecker::with('user_data', 'room_data')
                    ->where('user_id', Auth::user()->id)
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->latest()
                    ->get();
            } else if ($month == null && $year != null) {
                $filteredData = RoomChecker::with('user_data', 'room_data')
                    ->where('user_id', Auth::user()->id)
                    ->whereYear('date', $year)
                    ->latest()
                    ->get();
            } else {
                $filteredData = RoomChecker::with('user_data', 'room_data')->where('user_id', Auth::user()->id)->latest()->get();
            }
        }

        return $filteredData;
    }

    public function getByDate($date)
    {
        return RoomChecker::with('room_data')->where('date', $date)->latest()->get();
    }

    // Fungsi untuk mendapatkan data Tag berdasarkan ID
    public function getByRoomId($room_id): array|Collection
    {
        // Mencari tag berdasarkan ID, atau gagal jika tidak ditemukan
        return RoomChecker::with('room_data', 'user_data')->where('room_id', $room_id)->latest()->get();
    }

    // Fungsi untuk mendapatkan data Tag berdasarkan ID
    public function getById($id): RoomChecker
    {
        // Mencari tag berdasarkan ID, atau gagal jika tidak ditemukan
        return RoomChecker::findOrFail($id);
    }

    // Fungsi untuk menyimpan data Tag baru
    public function store(array $data): RoomChecker
    {
        // Membuat tag baru dengan data yang diberikan
        return RoomChecker::create($data);
    }

    // Fungsi untuk mengupdate data Tag yang ada
    public function update(array $newData, RoomChecker $roomChecker): ?RoomChecker
    {
        // Mengupdate tag berdasarkan ID dengan data baru yang diberikan
        $is_updated = RoomChecker::whereId($roomChecker->id)->update($newData);
        // Mengambil tag yang telah diperbarui
        $get_roomCheckher = $this->getById($roomChecker->id);
        // Mengembalikan tag yang diperbarui jika berhasil, atau null jika gagal
        return $is_updated ? $get_roomCheckher : null;
    }

    // Fungsi untuk menghapus data Tag
    public function delete($id): ?RoomChecker
    {
        $get_roomChecker = $this->getById($id);
        // Menghapus tag berdasarkan ID
        $is_deleted = RoomCategory::destroy($id);
        // Mengembalikan tag yang dihapus jika berhasil, atau null jika gagal
        return $is_deleted ? $get_roomChecker : null;
    }
}

