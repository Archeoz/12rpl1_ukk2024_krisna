<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
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
    return view('login');
})->name('/');
Route::post('postlogin', [UserController::class, 'postlogin']);

Route::get('admin', function () {
    return view('admin.login');
});
Route::post('postloginadmin', [AdminController::class, 'postlogin']);

Route::get('register', function () {
    return view('register');
});
Route::post('postregister', [UserController::class, 'postregister']);

Route::get('logout', [UserController::class, 'logout']);

Route::get('forgpass', function () {
    return view('forgpass');
});
Route::post('forgpasspost', [UserController::class, 'forgpasspost']);
Route::post('recvpasspost/{id}', [UserController::class, 'recvpasspost']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('mainpage', [GalleryController::class, 'mainpage']);
    Route::post('uploadfoto', [GalleryController::class, 'upload']);
    Route::post('editfoto/{id_gallery}', [GalleryController::class, 'edit']);
    Route::get('hapusfoto/{id_gallery}', [GalleryController::class, 'hapus']);

    Route::post('editprofile/{id}', [UserController::class, 'editprofile']);

    Route::get('adminpage', [AdminController::class, 'userdata']);
    Route::get('userdata', [AdminController::class, 'userdata']);
    Route::post('edituserdata', [AdminController::class, 'edituserdata']);
    Route::get('userupload', [AdminController::class, 'userupload']);
    Route::post('edituserupload', [AdminController::class, 'edituserupload']);
});
