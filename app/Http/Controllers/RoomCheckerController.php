<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Http\Requests\RoomCategory\StoreRoomCategoryRequest;
use App\Http\Requests\RoomCategory\UpdateRoomCategoryRequest;
use App\Http\Requests\RoomChecker\StoreRoomCheckerRequest;
use App\Http\Requests\RoomChecker\UpdateRoomCheckerRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Interfaces\RoomCategoryRepositoryInterface;
use App\Interfaces\RoomCheckerRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomChecker;
use App\Models\Tag;
use App\Utils\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomCheckerController extends Controller
{
    public function __construct(
        private readonly RoomRepositoryInterface $roomRepositoryInterface,
        private readonly RoomCheckerRepositoryInterface $roomCheckerRepositoryInterface,
        private readonly UploadFile $uploadFile,
    ) {
    }

    /**
     * Menampilkan daftar resource (tag).
     */
    public function index()
    {
        // Mengambil semua data tag melalui repository
        $rooms = $this->roomRepositoryInterface->getAll();
        $roomCheckhers = $this->roomCheckerRepositoryInterface->getAll();
        // Mengirim respon sukses dengan data tag
        return view('dashboard.roomCheckers.index', compact('rooms', 'roomCheckhers'));
    }

    public function detail($id)
    {
        try {
            // Mengambil data tag berdasarkan ID melalui repository
            $room = $this->roomRepositoryInterface->getById($id);
            $roomChecker = $this->roomCheckerRepositoryInterface->getByRoomId($id);

            // Mengirim respon sukses dengan data tag
            return view('dashboard.roomCheckers.detail', compact('room', 'roomChecker'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return abort(404);
        }
    }

    /**
     * Menampilkan view Room Category tag
     */
    public function create($room_id)
    {
        $room = $this->roomRepositoryInterface->getById($room_id);
        return view('dashboard.roomCheckers.create',compact('room'));
    }

    /**
     * Menampilkan view edit tag
     */
    public function edit(RoomChecker $roomChecker)
    {
        $room = $this->roomRepositoryInterface->getAll();
        return view('dashboard.rooms.edit', compact('roomChecker', 'room'));
    }

    /**
     * Menyimpan resource baru (tag) ke dalam penyimpanan.
     */
    public function store(StoreRoomCheckerRequest $request)
    {
//        dd($request);
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            $newRoomChecker = $request->validated();
            $filename = $this->uploadFile->uploadSingleFile($newRoomChecker["image"], "rooms");
            $newRoomChecker["image"] = $filename;
            $newRoomChecker['user_id'] = Auth::user()->id;
            $roomChecker = $this->roomCheckerRepositoryInterface->store($newRoomChecker);
            DB::commit();
            return redirect()->route('rooms.show', $request['room_id'])->with('success', 'Pengecekan ruangan berhasil ditambahkan');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Pengecekan ruangan gagal ditambahkan');
        }
    }

    /**
     * Menampilkan resource yang ditentukan (tag berdasarkan ID).
     */
    public function show($id)
    {
        try {
            // Mengambil data tag berdasarkan ID melalui repository
            $roomChecker = $this->roomCheckerRepositoryInterface->getById($id);
            // Mengirim respon sukses dengan data tag
            return view('dashboard.roomChecker.show', compact('roomChecker'));
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
    public function update(UpdateRoomCheckerRequest $request, RoomChecker $roomChecker)
    {
//        dd($request);
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            $updateRoomChecker = $request->validated();
            if($request->has('image')) {
                $this->uploadFile->deleteExistFile($roomChecker->image);
                $filename = $this->uploadFile->uploadSingleFile($updateRoomChecker["image"], "rooms");
                $updateRoomChecker["image"] = $filename;
            }

            // Memperbarui tag melalui repository
            $roomChecker = $this->roomRepositoryInterface->update($updateRoomChecker, $updateRoomChecker);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil diupdate"
            return redirect()->route('rooms.show', ['id' => $updateRoomChecker['room_id']])->with('success', 'Pengecekan ruangan berhasil diupdate');
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
    public function destroy(RoomChecker $roomChecker)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Menghapus tag melalui repository
            $room = $this->roomCheckerRepositoryInterface->delete($roomChecker->id);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil dihapus"
            return redirect()->route('rooms.show', ['id' => $roomChecker['room_id']])->with('success', 'Pengecekan ruangan berhasil dihapus');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'pengecekan ruangan gagal dihapus');
        }
    }
}
