<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Http\Requests\RoomCategory\StoreRoomCategoryRequest;
use App\Http\Requests\RoomCategory\UpdateRoomCategoryRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Interfaces\RoomCategoryRepositoryInterface;
use App\Interfaces\RoomCheckerRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Tag;
use App\Utils\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class TagRepositoryInterface
    public function __construct(
        private readonly RoomRepositoryInterface $roomRepositoryInterface,
        private readonly RoomCategoryRepositoryInterface $roomCategoryRepositoryInterface,
        private readonly RoomCheckerRepositoryInterface $roomCheckerRepositoryInterface,
        private readonly UploadFile $uploadFile
    ) {
    }

    /**
     * Menampilkan daftar resource (tag).
     */
    public function index()
    {
        // Mengambil semua data tag melalui repository
        $rooms = $this->roomRepositoryInterface->getAll();

        // Mengirim respon sukses dengan data tag
        return view('dashboard.rooms.index', compact('rooms'));
    }

    /**
     * Menampilkan view Room Category tag
     */
    public function create()
    {
        $roomCategories = $this->roomCategoryRepositoryInterface->getAll();
        return view('dashboard.rooms.create', compact('roomCategories'));
    }

    /**
     * Menampilkan view edit tag
     */
    public function edit(Room $room)
    {
        $roomCategories = $this->roomCategoryRepositoryInterface->getAll();
        return view('dashboard.rooms.edit', compact('room', 'roomCategories'));
    }

    /**
     * Menyimpan resource baru (tag) ke dalam penyimpanan.
     */
    public function store(StoreRoomRequest $request)
    {
//        dd($request);
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            $newRoom = $request->validated();
            $filename = $this->uploadFile->uploadSingleFile($newRoom["image"], "rooms");
            $newRoom["image"] = $filename;
            $newRoom["slug"] = str()->slug($newRoom["name"]);
            $newRoom['status'] = $request->status == "on" ? 'active' : 'inactive';
            $room = $this->roomRepositoryInterface->store($newRoom);
            DB::commit();
            return redirect()->route("rooms.index")->with('success', 'Ruangan berhasil ditambahkan');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Ruangan gagal ditambahkan');
        }
    }

    /**
     * Menampilkan resource yang ditentukan (tag berdasarkan ID).
     */
    public function show($id)
    {
        try {
            // Mengambil data tag berdasarkan ID melalui repository
            $room = $this->roomRepositoryInterface->getById($id);
            $roomChecker = $this->roomCheckerRepositoryInterface->getByRoomId($id);

            // Mengirim respon sukses dengan data tag
            return view('dashboard.rooms.show', compact('room', 'roomChecker'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return abort(404);
        }
    }

    /**
     * Memperbarui resource yang ditentukan (tag berdasarkan ID).
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
//        dd($request);
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            $updateRoom = $request->validated();
            if($request->has('image')) {
                $this->uploadFile->deleteExistFile($room->image);
                $filename = $this->uploadFile->uploadSingleFile($updateRoom["image"], "rooms");
                $updateRoom["image"] = $filename;
            }
            $updateRoom['status'] = $request->status == "on" ? 'active' : 'inactive';
            $updateRoom["slug"] = str()->slug($updateRoom["name"]);

            // Memperbarui tag melalui repository
            $room = $this->roomRepositoryInterface->update($updateRoom, $room);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil diupdate"
            return redirect()->route("rooms.index")->with('success', 'Ruangan berhasil diupdate');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Ruangan gagal diupdate');
        }
    }

    /**
     * Menghapus resource yang ditentukan (tag).
     */
    public function destroy(Room $room)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Menghapus tag melalui repository
            $room = $this->roomRepositoryInterface->delete($room->id);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil dihapus"
            return redirect()->route("rooms.index")->with('success', '  Ruangan berhasil dihapus');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'kategori ruangan gagal dihapus');
        }
    }
}
