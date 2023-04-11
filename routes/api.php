<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\CompanyJobController;
use App\Http\Controllers\API\JobController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('app-logout');

    Route::apiResource('company', CompanyController::class)->except(['update']);
    Route::post('company-update', [CompanyController::class, 'update'])->name('company.update');

    Route::post('/job', [JobController::class, 'store'])->name('job.store');
    Route::put('/job/{job}', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/{job}', [JobController::class, 'destroy'])->name('job.delete');
    Route::get('/job/{job}', [JobController::class, 'show'])->name('job.show');
    Route::get('/job', [JobController::class, 'index'])->name('job.index');

    Route::get('/company-job',[CompanyJobController::class,'index'])->name('company-job.index');
    Route::get('/company-job/{job}',[CompanyJobController::class,'show'])->name('company-job.show');
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('app-login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('app-register');
