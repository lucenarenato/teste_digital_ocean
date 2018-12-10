<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);

        \App\Product::creating(function ($model) {
            $tax = .20;
     
            if ($model->quantity < 10) { $model->price += $model->price * $tax;
            } else if ($model->quantity >= 10) {
                $model->price += $model->price * ($tax / 2);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
