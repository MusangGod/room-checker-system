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

class ReportController extends Controller
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
    public function index(Request $request)
    {
        $month = $request['month'];
        $year = $request['year'];
        $roomChecker = $this->roomCheckerRepositoryInterface->getByMonthAndYear($request['month'], $request['year']);
        // Mengirim respon sukses dengan data tag
        return view('dashboard.reports.index', compact('roomChecker', 'month', 'year'));
    }

    public function detail(Request $request)
    {
        try {
            // Mengambil data tag berdasarkan ID melalui repository
            $roomChecker = $this->roomCheckerRepositoryInterface->getByMonthAndYear($request['month'], $request['year']);

            // Mengirim respon sukses dengan data tag
            return view('dashboard.reports.index', compact('roomChecker'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return abort(404);
        }
    }
    public function show($id)
    {
        try {
            // Mengambil data tag berdasarkan ID melalui repository
            $roomChecker = $this->roomCheckerRepositoryInterface->getById($id);
            $room = $this->roomRepositoryInterface->getById($roomChecker->room_id);
            // Mengirim respon sukses dengan data tag
            return view('dashboard.roomCheckers.show', compact('roomChecker', 'room'));
        } catch (\Exception $ex) {
            // Mengirim respon error jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return abort(404);
        }
    }
}
