<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\RoomCategory\StoreRoomCategoryRequest;
use App\Http\Requests\RoomCategory\UpdateRoomCategoryRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Interfaces\RoomCategoryRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Models\RoomCategory;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class RoomCategoryController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class TagRepositoryInterface
    public function __construct(
        private readonly RoomCategoryRepositoryInterface $roomCategoryRepositoryInterface
    ) {
    }

    /**
     * Menampilkan daftar resource (tag).
     */
    public function index()
    {
        // Mengambil semua data tag melalui repository
        $roomCategories = $this->roomCategoryRepositoryInterface->getAll();

        // Mengirim respon sukses dengan data tag
        return view('dashboard.roomCategories.index', compact('roomCategories'));
    }

    /**
     * Menampilkan view Room Category tag
     */
    public function create()
    {
        return view('dashboard.roomCategories.create');
    }

    /**
     * Menampilkan view edit tag
     */
    public function edit(RoomCategory $roomCategory)
    {
        return view('dashboard.roomCategories.edit', compact('roomCategory'));
    }

    /**
     * Menyimpan resource baru (tag) ke dalam penyimpanan.
     */
    public function store(StoreRoomCategoryRequest $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data baru ke dalam variabel
            $newRoomCategory = $request->validated();
            // Mengatur slug berdasarkan nama tag
            $newRoomCategory["slug"] = str()->slug($newRoomCategory["name"]);
            // Menyimpan tag baru melalui repository
            $roomCategory = $this->roomCategoryRepositoryInterface->store($newRoomCategory);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil ditambahkan"
            return redirect()->route("roomCategories.index")->with('success', 'Kategori ruangan berhasil ditambahkan');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Kategori kategori ruangan gagal ditambahkan');
        }
    }

    /**
     * Menampilkan resource yang ditentukan (tag berdasarkan ID).
     */
    public function show($id)
    {
        try {
            // Mengambil data tag berdasarkan ID melalui repository
            $roomCategory = $this->roomCategoryRepositoryInterface->getById($id);

            // Mengirim respon sukses dengan data tag
            return view('dashboard.roomCategories.show', compact('roomCategory'));
        } catch (\Exception $ex) {
            // Mengirim respon error jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return abort(404);
        }
    }

    /**
     * Memperbarui resource yang ditentukan (tag berdasarkan ID).
     */
    public function update(UpdateRoomCategoryRequest $request, RoomCategory $roomCategory)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data yang diupdate ke dalam variabel
            $updateRoomCategory = $request->validated();
            // Mengatur slug berdasarkan nama tag
            $updateRoomCategory["slug"] = str()->slug($updateRoomCategory["name"]);

            // Memperbarui tag melalui repository
            $roomCategory = $this->roomCategoryRepositoryInterface->update($updateRoomCategory, $roomCategory);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil diupdate"
            return redirect()->route("roomCategories.index")->with('success', 'Kategori Ruangan berhasil diupdate');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Kategori ruangan gagal diupdate');
        }
    }

    /**
     * Menghapus resource yang ditentukan (tag).
     */
    public function destroy(RoomCategory $roomCategory)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Menghapus tag melalui repository
            $roomCategory = $this->roomCategoryRepositoryInterface->delete($roomCategory->id);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil dihapus"
            return redirect()->route("roomCategories.index")->with('success', 'Kategori Ruangan berhasil dihapus');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'kategori ruangan gagal dihapus');
        }
    }
}
