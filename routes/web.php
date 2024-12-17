<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContributorController;
use App\Http\Controllers\PengirimController;
use App\Http\Controllers\PostController;

//kontributor
Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'dashboardkontributor'])->name('post.dash');
    Route::get('/postview', [PostController::class, 'postkontributor'])->name('post.view');
    Route::get('/postnews', [PostController::class, 'tambahposting'])->name('post.add');
    Route::post('/postnews/simpan', [PostController::class, 'simpanposting'])->name('post.store');
    Route::get('/post/{post_name}/edit', [PostController::class, 'editposting'])->name('post.edit');
    Route::put('/post/{post_name}/update', [PostController::class, 'updateposting'])->name('post.update');
    Route::delete('/postnews/{post}/delete', [PostController::class, 'destroyposting'])->name('post.destroy');
    Route::get('/post/{post_name}', [PostController::class, 'show'])->name('post.show');
});

// admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/postall', [AdminController::class, 'index'])->name('admin.postall');
    Route::get('/admin', [AdminController::class, 'dashboardadmin'])->name('admin.dash');
    Route::get('/adminnews', [AdminController::class, 'tambahadmin'])->name('admin.add');
    Route::post('/adminnews/simpan', [AdminController::class, 'simpanadmin'])->name('admin.store');
    Route::get('/adminnews/{post_name}/edit', [AdminController::class, 'editadmin'])->name('admin.edit');
    Route::put('/adminnews/{post_name}/update', [AdminController::class, 'updateadmin'])->name('admin.update');
    Route::delete('/adminnews/{post_name}', [AdminController::class, 'destroyadmin'])->name('admin.destroy');
    Route::get('/pengirim', [PengirimController::class, 'showTable']);
    Route::post('/send-kwitansi/{id}', [PengirimController::class, 'sendKwitansi']);
});


Route::post('/upload', [PostController::class, 'upload'])->name('ckeditor.upload');

Route::get('/download/{id}', [PengirimController::class, 'downloadFile'])->name('file.download');


Route::get('/form', [PengirimController::class, 'index']);
Route::post('/form/simpan', [PengirimController::class, 'store']);
Route::get('/invoice/{id}', [PengirimController::class, 'generateInvoice']);
Route::post('/upload-bukti/{id}', [PengirimController::class, 'uploadBuktiBayar']);





// Route::get('/', function () {
//     return view('auth/login');
// });

// Route::get('/ss', function () {
//     return view('admin.dashboard');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// Route::get('/', [ContributorController::class, 'index'])->name('dashboard');
// Route::get('/', [PostController::class, 'dashboardkontributor'])->name('post.dash');
// kontributor
// Route::get('/aa', [PostController::class, 'dashboardkontributor'])->name('post.dash');

// // kontributor
// Route::get('/dashboard', [ContributorController::class, 'index'])->name('dashboard');

// // admin
// Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

require __DIR__ . '/auth.php';
