<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Snippet;
use App\Models\SnippetView;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        $sharedData = [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $request->user(),
            ],
            'quote' => ['message' => trim($message), 'author' => trim($author)],
        ];

        // Only add dashboard data if the user is authenticated
        if ($request->user()) {
            $user = $request->user();

            // Get monthly views with only the month number
            $realMonthlyViews = SnippetView::join('snippets', 'snippets.id', '=', 'snippet_views.snippet_id')
                ->where('snippets.user_id', $user->id)
                ->whereYear('viewed_at', now()->year)
                ->selectRaw("strftime('%m', viewed_at) as month_num, COUNT(*) as views")
                ->groupBy('month_num')
                ->orderBy('month_num')
                ->pluck('views', 'month_num')
                ->toArray();

            // Convert month numbers to names
            $months = [
                '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
                '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug',
                '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'
            ];

            $monthlyViewsFormatted = [];
            foreach ($realMonthlyViews as $monthNum => $views) {
                $monthName = $months[$monthNum] ?? 'Unknown';
                $monthlyViewsFormatted[$monthName] = $views;
            }

            $sharedData['dashboardData'] = [
                'totalSnippets' => Snippet::where('user_id', $user->id)->count(),
                'totalViews' => Snippet::where('user_id', $user->id)->sum('views_count'),
                'totalFavorites' => Snippet::where('user_id', $user->id)->sum('favorites_count'),
                'monthlyViews' => $monthlyViewsFormatted,
                'popularSnippets' => Snippet::where('user_id', $user->id)
                    ->orderBy('views_count', 'desc')
                    ->limit(10)
                    ->get(['id', 'title', 'views_count as views', 'language'])
                    ->toArray(),
            ];
        }

        return $sharedData;
    }
}
