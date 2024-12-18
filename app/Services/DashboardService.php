<?php
namespace App\Services;

use App\Http\Controllers\MejaController;
use App\Http\Controllers\UserController;

class DashboardService
{
    public function getData()
    {
        $mejaData = app(MejaController::class)->index();
        $userData = app(UserController::class)->showUsers();

        return compact('mejaData', 'userData');
    }
}