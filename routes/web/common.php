<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SingerController;

Route::get('/change-language/{language}',[HomeController::class, 'change_language'])->name('home.changeLanguage');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/student', [HomeController::class, 'student'])->name('admin.student')->middleware('auth');
Route::post('/admin/create', [HomeController::class, 'create'])->name('admin.create')->middleware('auth');
Route::get('/admin/delete/{id}', [HomeController::class, 'delete'])->name('admin.delete')->middleware('auth');
Route::get('/admin/update/{id}', [HomeController::class, 'update'])->name('admin.update')->middleware('auth');
Route::get('/admin/send-mail/{id}', [HomeController::class, 'sendMail'])->name('admin.sendMail')->middleware('auth');
Route::get('/admin/view/{id}', [HomeController::class, 'viewMail'])->name('admin.viewMail')->middleware('auth');
Route::get('/admin/send-mail/{id}', [HomeController::class, 'sendMail'])->name('admin.sendMail')->middleware('auth');

Route::get('/admin/department', [HomeController::class, 'department'])->name('admin.department')->middleware('auth');
Route::post('/admin/create_department', [HomeController::class, 'create_department'])->name('admin.create_department')->middleware('auth');
Route::get('/admin/delete_department/{id}', [HomeController::class, 'delete_department'])->name('admin.delete_department')->middleware('auth');
Route::get('/admin/edit_department/{id}', [HomeController::class, 'edit_department'])->name('admin.edit_department')->middleware('auth');



Route::get('/dashboard', function () {
            return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
