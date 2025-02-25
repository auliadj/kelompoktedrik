<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


Route::get('/login', function () {
    return view('auth.login'); // Pastikan ada file view auth/login.blade.php
})->name('login');

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function(){
    require base_path('routes/api.php');
});