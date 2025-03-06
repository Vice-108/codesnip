<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Snippet;
use App\Policies\SnippetPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Snippet::class, SnippetPolicy::class);
    }
}
