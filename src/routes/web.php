<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// ダッシュボード（認証必須）
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// 管理画面（認証必須）
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        // 一覧表示
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // 検索
        Route::get('/search', [AdminController::class, 'search'])->name('search');

        // リセット
        Route::get('/reset', [AdminController::class, 'reset'])->name('reset');

        // エクスポート
        Route::get('/export', [AdminController::class, 'export'])->name('export');

        // 削除
        Route::delete('/contacts/{contact}', [AdminController::class, 'destroy'])
            ->name('destroy');
    });
});

// お問い合わせフォーム（一般ユーザー側）
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');
Route::post('/contacts/back', [ContactController::class, 'back'])->name('contacts.back');
Route::match(['get', 'post'], '/contacts/confirm', [ContactController::class, 'confirm'])
    ->name('contacts.confirm');

// 認証ルート
require __DIR__ . '/auth.php';
