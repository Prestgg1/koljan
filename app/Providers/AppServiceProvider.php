<?php

namespace App\Providers;

use App\Models\BalanceTransaction;
use App\Observers\BalanceTransactionObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Vite;
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
        BalanceTransaction::observe(BalanceTransactionObserver::class);
        Schema::defaultStringLength(191);
        Vite::prefetch(concurrency: 3);
    }
}
