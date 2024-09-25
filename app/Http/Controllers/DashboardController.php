<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\StaffRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class PostRepositoryInterface dan TagRepositoryInterface
    public function __construct(
        private readonly RoomRepositoryInterface $roomRepositoryInterface,
        private readonly StaffRepositoryInterface $staffRepositoryInterface,
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $rooms_count = count($this->roomRepositoryInterface->getAll());
        $staffs_count = count($this->staffRepositoryInterface->getAll());

        return view('dashboard.index', compact('staffs_count', 'rooms_count'));
    }
}
