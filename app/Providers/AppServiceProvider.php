<?php

namespace App\Providers;

use App\Models\ClassWork;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Cashier::ignoreMigrations();

        if (App::environment('production')) {
            $this->app->instance('path.public', base_path('public_html'));
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Relation::enforceMorphMap([
            'classwork' => ClassWork::class,
            'post' => Post::class
        ]);

    }
}
