<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CompetenceController;
use App\Http\Controllers\API\ExperienceController;
use App\Http\Controllers\API\FormationController;
use App\Http\Controllers\API\LangueController;
use App\Http\Controllers\API\ProfilController;
use App\Http\Controllers\API\VoirController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return [
        'message' => 'Welcome'
    ];
})->middleware('auth')->name('api-home');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('app-logout');

    Route::post();
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('app-login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('app-register');
