<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Add this route for admin dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Add this route for file management
Route::get('/admin/file-management', function () {
    return view('admin.filemanagement');
})->name('admin.filemanagement');