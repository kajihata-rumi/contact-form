<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');
});

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');

Route::post('/contacts/back', [ContactController::class, 'back'])->name('contacts.back');

Route::match(['get', 'post'], '/contacts/confirm', [ContactController::class, 'confirm'])
    ->name('contacts.confirm');


require __DIR__ . '/auth.php';
