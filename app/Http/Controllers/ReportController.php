<?php

namespace App\Http\Controllers;

use App\Exports\RoomCheckerExport;
use App\Interfaces\RoomCheckerRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct(
        private readonly RoomRepositoryInterface $roomRepositoryInterface,
        private readonly RoomCheckerRepositoryInterface $roomCheckerRepositoryInterface,
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
        session(['roomChecker' => $roomChecker, 'month' => $month, 'year' => $year]);
//        dd($this->roomChecker);
        // Mengirim respon sukses dengan data tag
        return view('dashboard.reports.index', compact('roomChecker', 'month', 'year'));
    }

    public function export()
    {
        $roomChecker = session('roomChecker');
        $request = ['month' => session('month'), 'year' => session('year')];
        if (!$roomChecker) {
            return view('dashboard.reports.index')->with('error', 'Data pengecekan ruangan tidak ada.');
        }
//        $filePath = 'exports/data-pengecekan-ruangan.xlsx';
//        $excel = Excel::download(new RoomCheckerExport($roomChecker), 'data-pengecekan-ruangan.xlsx');
        return  Excel::download(new RoomCheckerExport($roomChecker), 'data-pengecekan-ruangan.xlsx');
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
