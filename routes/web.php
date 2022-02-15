<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilepondController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('app');
});
Route::get('/two', function () {
    return view('multi');

});Route::get('/multi', function () {
    return view('multi');
});

Route::any('/uploads', [Controller::class, 'upload']);
Route::any('/pond', [Controller::class, 'pond']);
//Route::any('/uploader', [Controller::class, 'uploader']);
Route::post("/filepond",[FilepondController::class,"upload"]);
Route::post("/fileUpload",[FilepondController::class,"fileUpload"]);
