<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class PostRepositoryInterface dan TagRepositoryInterface
    public function __construct(
        private readonly PostRepositoryInterface $postRepositoryInterface,
        private readonly TagRepositoryInterface $tagRepositoryInterface
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Get Data This Year
        $postData = Post::select(DB::raw("COUNT(*) as count"))
            ->whereYear("created_at", date('Y'))                    				
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck("count");

        $months = Post::select(DB::raw("Month(created_at) as month"))
            ->whereYear('created_at', date('Y'))                
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck("month");

        $post_yearly = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,);
        foreach ($months as $index => $month) {
            $post_yearly[$month - 1] = $postData[$index];
        }

        // Get Data This Week
        $post_weekly = [0, 0, 0, 0, 0, 0, 0];

        foreach ($post_weekly as $key => $item) {
            $getPostCurrentWeek = Post::select(DB::raw("COUNT(*) as count"))
                                            ->whereDate('created_at', [Carbon::now()->startOfWeek()->addDays($key)->format('Y-m-d')])                                                
                                            ->groupBy(DB::raw("Date(created_at)"))
                                            ->pluck("count")
                                            ->toArray();

            $post_weekly[$key] = count($getPostCurrentWeek) ? $getPostCurrentWeek[0] : 0;
        }	

        // Get Data This Month
        $post_monthly = [0, 0, 0, 0];

        foreach ($post_monthly as $key => $item) {
            $getPostCurrentWeek = Post::select(DB::raw("COUNT(*) as count"))
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth()->addWeeks($key)->startOfWeek(),
                Carbon::now()->startOfMonth()->addWeeks($key)->endOfWeek(),
            ])
            ->groupBy(DB::raw("Week(created_at)"))
            ->pluck("count")
            ->toArray();

            $post_monthly[$key] = count($getPostCurrentWeek) ? $getPostCurrentWeek[0] : 0;
        }

        $posts_count = count($this->postRepositoryInterface->getAll());
        $tags_count = count($this->tagRepositoryInterface->getAll());
        
        return view('dashboard.index', compact('post_yearly', 'post_monthly', 'post_weekly', 'posts_count', 'tags_count'));
    }
}
