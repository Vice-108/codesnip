<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Snippet;
use App\Models\SnippetView;
use Illuminate\Support\Facades\DB;

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

            // Get monthly views with month names directly from MySQL
            $monthlyViews = DB::table(function($query) use ($user) {
                $query->from('snippet_views')
                    ->join('snippets', 'snippets.id', '=', 'snippet_views.snippet_id')
                    ->where('snippets.user_id', $user->id)
                    ->whereYear('viewed_at', now()->year)
                    ->selectRaw("MONTH(viewed_at) as month_num, LEFT(MONTHNAME(viewed_at), 3) as month, COUNT(*) as views")
                    ->groupBy('month_num', 'month');
            })
            ->orderBy('month_num')
            ->pluck('views', 'month')
            ->toArray();

            $sharedData['dashboardData'] = [
                'totalSnippets' => Snippet::where('user_id', $user->id)->count(),
                'totalViews' => Snippet::where('user_id', $user->id)->sum('views_count'),
                'totalFavorites' => Snippet::where('user_id', $user->id)->sum('favorites_count'),
                'monthlyViews' => $monthlyViews,
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
