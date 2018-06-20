<?php
namespace FLA\Common;

use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        require __DIR__ . '/Routes/api.php';
    }
}