<?php
namespace FLA\Common;

use FLA\Common\BusinessObject\BusinessFunction\role\CountRoleListAdvance;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {

        // Register all services

    }

    public function boot()
    {
        require __DIR__ . '/Routes/api.php';
        require __DIR__ . '/Routes/web.php';
    }

    private function services() {
        $this->registerService("countRoleListAdvance", CountRoleListAdvance::class);
        $this->registerService("findCurrentUserRoleByToken", FindCurrentUserRoleByToken::class);
        $this->registerService("findDefaultUserRoleByUserId", FindDefaultUserRoleByUserId::class);
        $this->registerService("findRoleById", FindRoleById::class);
        $this->registerService("getRoleListAdvance", GetRoleListAdvance::class);
        $this->registerService("getRoleListByUserId", GetRoleListByUserId::class);
        $this->registerService("getRoleTaskListByRoleId", GetRoleTaskListByRoleId::class);
        $this->registerService("isRoleExistsByIndex", IsRoleExistsByIndex::class);

    }

    private function registerService($className, $serviceName = "") {
        $this->app->singleton($serviceName, function() use ($className) {
            return new $className;
        });
    }
}