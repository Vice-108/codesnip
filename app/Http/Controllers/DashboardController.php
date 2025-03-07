<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index()
    {
        // $user = auth()->user();

        // $totalSnippets = Snippet::where('user_id', $user->id)->count();

        // $totalViews = Snippet::where('user_id', $user->id)->sum('views_count');

        // $totalFavorites = Snippet::where('user_id', $user->id)->sum('favorites_count');

        // $monthlyViews = Snippet::where('user_id', $user->id)
        //             ->selectRaw("strftime('%m', created_at) as month_num, strftime('%b', created_at) as month, SUM(views_count) as views")
        //             ->whereRaw("strftime('%Y', created_at) = ?", [now()->year])
        //             ->groupBy('month')
        //             ->orderBy('month_num')
        //             ->pluck('views', 'month')
        //             ->toArray();

        // $popularSnippets = Snippet::where('user_id', $user->id)
        //     ->orderBy('views_count', 'desc')
        //     ->limit(10)
        //     ->get(['id', 'title', 'views_count as views', 'language'])
        //     ->toArray();

        // $dashboardData = [
        //     'totalSnippets' => $totalSnippets,
        //     'totalViews' => $totalViews,
        //     'totalFavorites' => $totalFavorites,
        //     'monthlyViews' => $monthlyViews,
        //     'popularSnippets' => $popularSnippets,
        // ];
        // return Inertia::render('Dashboard', [
        //     'dashboardData' => $dashboardData
        // ]);
    }
}
