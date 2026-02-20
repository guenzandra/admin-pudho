<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Add this route for admin dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

//route for dashboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Route for Filemanagement Page
Route::get('/filemanagement', function () {
    return view('admin.filemanagement');
})->name('filemanagement');

// Add this route for residents page
Route::get('/residents', function () {
    return view('admin.residents');
})->name('residents');

// Route for CMS Dropdown Page
   //route for announcement page
Route::get('/announcement', function () {
    return view('admin.cms-dropdown.announcement');
})->name('announcement');

    //articles
Route::get('/articles', function () {
    return view('admin.cms-dropdown.articles');
})->name('articles');

    //media
Route::get('/media', function () {
    return view('admin.cms-dropdown.media');
})->name('media');

   //news
Route::get('/news', function () {
    return view('admin.cms-dropdown.news');
})->name('news');


//route for check-missing-files page
Route::get('/cmissingfiles', function () {
    return view('admin.cmissingfiles');
})->name('cmissingfiles');


//route for antisquatting-dropdown page
        //reports
Route::get('/reports', function () {
    return view('admin.anti-dropdown.reports');
})->name('reports');

        //investigation
Route::get('/investigation', function () {
    return view('admin.anti-dropdown.investigation');
})->name('investigation');

        //map view
Route::get('/mapview', function () {
    return view('admin.anti-dropdown.mapview');
})->name('mapview');

//route for message dropdown page
        //archived messages
Route::get('/archived', function () {
    return view('admin.messages.archived');
})->name('archived');

        //inbox
Route::get('/inbox', function () {
    return view('admin.messages.inbox');
})->name('inbox');

        //sent messages
Route::get('/sent', function () {
    return view('admin.messages.sent');
})->name('sent');


//route for Faqs dropdown page
    //answered
Route::get('/answered', function () {
    return view('admin.faqs.answered');
})->name('answered');

    //pending questions
Route::get('/pending', function () {
    return view('admin.faqs.pending');
})->name('pending');

//route for user management page
Route::get('/usermanagement', function () {
    return view('admin.usermanagement');
})->name('usermanagement');

//route for reports and analytics page
Route::get('/reportsAnalytics', function () {
    return view('admin.reportsAnalytics');
})->name('reportsAnalytics');

//route for settings dropdown page
    //general settings
Route::get('/general', function () {
    return view('admin.settingsPudho.general');
})->name('general');

    //help
Route::get('/help', function () {
    return view('admin.settingsPudho.help');
})->name('help');

    //logs
Route::get('/logs', function () {
    return view('admin.settingsPudho.logs');
})->name('logs');

    //notifications
Route::get('/notifications', function () {
    return view('admin.settingsPudho.notifications');
})->name('notifications');

    //security
Route::get('/security', function () {
    return view('admin.settingsPudho.security');
})->name('security');

//route for profile page
Route::get('/profile', function () {
    return view('admin.profile');
})->name('profile');

//route for logout page
Route::get('welcome', function () {
    // Logic for logging out the user
    return redirect('/'); // Redirect to home page after logout
})->name('welcome');