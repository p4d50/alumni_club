<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified', 'approved'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'approved', 'admin'])->name('dashboard');

Route::get('/dashboard/approvals', [ApprovalController::class, 'dashboard'])->middleware(['auth', 'verified', 'approved', 'admin'])->name('dashboard.approvals');
Route::get('/dashboard/approvals/{user:id}', [ApprovalController::class, 'each'])->middleware(['auth', 'verified', 'approved', 'admin'])->name('dashboard.approvals.each');
Route::get('/dashboard/approvals/{user:id}/approve', [ApprovalController::class, 'approveUser'])->middleware(['auth', 'verified', 'approved', 'admin'])->name('dashboard.approvals.each.approve');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/not-approved', function () {
    return view('not-approved');
})->middleware(['auth'])->name('not-approved');

require __DIR__.'/auth.php';
