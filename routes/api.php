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
})->name('api-home');


