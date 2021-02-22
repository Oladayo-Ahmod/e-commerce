<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
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

Route::get('/logins', function () {
    return view('login');
});
Route::get('/logout', function () {
    Session::forget('user');
    return redirect('logins');
});
Route::post("/logins",[UsersController::class,'login']);
Route::post("/register",[UsersController::class,'register']);
Route::get('/',[ProductController::class,'index']);
Route::get('/cartlist',[ProductController::class,'showItem']);
Route::get('detail/{id}',[ProductController::class,'details']);
Route::get('removecart/{id}',[ProductController::class,'remove']);
Route::get('/search',[ProductController::class,'search']);
Route::post('/add_to_cart',[ProductController::class,'cart']);
Route::get('/ordernow',[ProductController::class,'ordernow']);
Route::post('/orderplace',[ProductController::class,'orderplace']);
Route::get('/orderlist',[ProductController::class,'order_list']);
Route::view('/register','register');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
