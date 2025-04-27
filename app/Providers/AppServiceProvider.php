<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        // Define custom validation rule for CNIC
        Validator::extend('cnic', function ($attribute, $value, $parameters, $validator) {
            // Add your CNIC validation logic here
            // You can use regular expressions or any other method to validate the CNIC format
            // Return true if the CNIC is valid, false otherwise
            return preg_match('/^\d{13}$/', $value); // Example: 13-digit numeric CNIC
        });
    }
}
