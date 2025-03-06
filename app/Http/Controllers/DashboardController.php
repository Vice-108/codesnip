<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get total snippets for the user
        $totalSnippets = Snippet::where('user_id', $user->id)->count();

        // Get total views across all user snippets
        $totalViews = Snippet::where('user_id', $user->id)->sum('views_count');

        // Get total favorites received
        $totalFavorites = Snippet::where('user_id', $user->id)->sum('favorites_count');

        // Get monthly views for the past year
        $monthlyViews = Snippet::where('user_id', $user->id)
            ->selectRaw('DATE_FORMAT(created_at, "%b") as month, SUM(views_count) as views')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('views', 'month')
            ->toArray();

        // Get popular snippets
        $popularSnippets = Snippet::where('user_id', $user->id)
            ->orderBy('views_count', 'desc')
            ->limit(10)
            ->get(['id', 'title', 'views_count as views', 'language'])
            ->toArray();

        return Inertia::render('Dashboard', [
            'dashboardData' => [
                'totalSnippets' => $totalSnippets,
                'totalViews' => $totalViews,
                'totalFavorites' => $totalFavorites,
                'monthlyViews' => $monthlyViews,
                'popularSnippets' => $popularSnippets,
            ]
        ]);
    }
}
