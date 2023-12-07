<?php

namespace App\Providers;

use App\Models\categories;
use App\Models\difficulty;
use App\Models\game_texts;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom validation rule for category

        Validator::extend('exists_in_categories', function ($attribute, $value, $parameters, $validator) {
            categories::where('id', $value)->exists();
        });

        // Custom validation rule for game_texts
        Validator::extend('exists_in_game_texts', function ($attribute, $value, $parameters, $validator) {
            game_texts::where('id', $value)->exists();
        });

        // Custom validation rule for difficulties
        Validator::extend('exists_in_difficulties', function ($attribute, $value, $parameters, $validator) {
            difficulty::where('id', $value)->exists();
        });
    }
}
