<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// kontributor
Route::get('/', [PostController::class, 'dashboardkontributor'])->name('post.dash');
Route::get('/postview', [PostController::class, 'postkontributor'])->name('post.view');
Route::get('/postnews', [PostController::class, 'tambahposting'])->name('post.add');
Route::post('/postnews/simpan', [PostController::class, 'simpanposting'])->name('post.store');
Route::get('/post/{post_name}/edit', [PostController::class, 'editposting'])->name('post.edit');
Route::put('/post/{post_name}/update', [PostController::class, 'updateposting'])->name('post.update');
Route::delete('/postnews/{post}/delete', [PostController::class, 'destroyposting'])->name('post.destroy');
Route::get('/post/{post_name}', [PostController::class, 'show'])->name('post.show');


// admin
Route::get('/admin', [AdminController::class, 'dashboardadmin'])->name('admin.dash');
Route::get('/adminnews', [AdminController::class, 'tambahadmin'])->name('admin.add');
Route::post('/adminnews/simpan', [AdminController::class, 'simpanadmin'])->name('admin.store');
Route::get('/adminnews/{post_name}/edit', [AdminController::class, 'editadmin'])->name('admin.edit');
Route::put('/adminnews/{post_name}/update', [AdminController::class, 'updateadmin'])->name('admin.update');
Route::delete('/adminnews/{post_name}', [AdminController::class, 'destroyadmin'])->name('admin.destroy');

