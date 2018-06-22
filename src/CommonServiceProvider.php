<?php
namespace FLA\Common;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        require __DIR__ . '/Routes/api.php';

        // map api route
        Route::prefix('api')
            ->group(__DIR__ . '/Routes/api.php');
    }
}