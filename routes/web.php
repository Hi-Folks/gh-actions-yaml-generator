<?php

use App\Http\Controllers\ConfiguratorController;
use App\Http\Controllers\DashboardController;
use App\Http\Resources\ConfigurationResource;
use App\Models\Configuration;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ConfiguratorController::class, 'index'])->name('index');
Route::get('/about', [ConfiguratorController::class, 'about'])->name('about');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/action', function () {
    //$type = "application/x-yaml";
    $type = 'text/x-yaml';
    $data = [
        'name' => 'Test Laravel Github action',
        'on_push' => true,
        'on_push_branches' => ['main', 'develop', 'feature/**'],
        'on_pullrequest' => true,
        'on_pullrequest_branches' => ['main'],
    ];

    return response()
        ->view('action_yaml', $data, 200)
        ->header('Content-Type', $type);
});

Route::get('/configurations', function () {
    return ConfigurationResource::collection(Configuration::all());
});
