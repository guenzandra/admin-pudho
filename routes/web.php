<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Editor\EditorController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Admin Guest Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
    Route::get('/check-auth', function() {
        if (Auth::check()) {
            $user = Auth::user();
            $redirects = [
                1 => '/admin/dashboard',
                2 => '/headOfficer/dashboard',
                3 => '/editor/dashboard',
                4 => '/housingOfficer/dashboard',
                5 => '/applicationEvaluator/dashboard',
                6 => '/staff/dashboard',
                7 => '/siteInspector/dashboard',
            ];
            
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'id' => $user->user_id,
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                    'role' => $user->role_name,
                    'role_no' => $user->role_no,
                ],
                'redirect' => $redirects[$user->role_no] ?? '/admin/dashboard'
            ]);
        }
        return response()->json(['authenticated' => false]);
    })->name('check-auth');
});

/*
|--------------------------------------------------------------------------
| Authenticated Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');
    
    // Role-specific dashboards
    Route::get('/housing/dashboard', function () {
        return view('admin.housing-dashboard');
    })->name('housing.dashboard');
    
    Route::get('/evaluator/dashboard', function () {
        return view('admin.evaluator-dashboard');
    })->name('evaluator.dashboard');
    
    Route::get('/inspector/dashboard', function () {
        return view('admin.inspector-dashboard');
    })->name('inspector.dashboard');
    
    // ============ CMS ROUTES ============
    // All Posts page - THIS IS THE ROUTE YOU NEED
    Route::get('/allpost', function () {
        return view('admin.cms-dropdown.allpost');
    })->name('allpost');  // This creates route name: admin.allpost
    
    // Add Post page
    Route::get('/addpost', [PostController::class, 'create'])->name('addpost');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // Media
    Route::get('/media', function () {
        return view('admin.cms-dropdown.media');
    })->name('media');
    
    // ============ USER MANAGEMENT ROUTES ============
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::patch('/users/{id}/status', [UserController::class, 'updateStatus'])->name('users.status');
    Route::delete('/users/{id}/archive', [UserController::class, 'archive'])->name('users.archive');
    Route::post('/generate-username', [UserController::class, 'generateUsername'])->name('users.generate-username');
    
    // User management page
    Route::get('/usermanagement', function () {
        return view('admin.usermanagement');
    })->name('usermanagement');
    
    // ============ ARCHIVE ROUTES ============
    Route::get('/archived-users', [UserController::class, 'getArchived'])->name('users.archived');
    Route::post('/archived-users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/archived-users/{id}', [UserController::class, 'permanentDelete'])->name('users.permanent-delete');
    Route::delete('/recycle-bin/empty', [UserController::class, 'emptyRecycleBin'])->name('users.empty-recycle-bin');
    
    // ============ ANTI-SQUATTING ROUTES ============
    Route::get('/overview', function () {
        return view('admin.anti-dropdown.overview');
    })->name('overview');
    
    Route::get('/reports', function () {
        return view('admin.anti-dropdown.reports');
    })->name('reports');
    
    Route::get('/investigation', function () {
        return view('admin.anti-dropdown.investigation');
    })->name('investigation');
    
    Route::get('/mapview', function () {
        return view('admin.anti-dropdown.mapview');
    })->name('mapview');
    
    Route::get('/residents', function () {
        return view('admin.residents');
    })->name('residents');
    
    Route::get('/filemanagement', function () {
        return view('admin.filemanagement');
    })->name('filemanagement');
    
    Route::get('/cmissingfiles', function () {
        return view('admin.cmissingfiles');
    })->name('cmissingfiles');
    
    // ============ MESSAGES ROUTES ============
    Route::get('/inbox', function () {
        return view('admin.messages.inbox');
    })->name('inbox');
    
    Route::get('/sent', function () {
        return view('admin.messages.sent');
    })->name('sent');
    
    Route::get('/archived', function () {
        return view('admin.messages.archived');
    })->name('archived');
    
    // ============ FAQS ROUTES ============
    Route::get('/answered', function () {
        return view('admin.faqs.answered');
    })->name('answered');
    
    Route::get('/pending', function () {
        return view('admin.faqs.pending');
    })->name('pending');
    
    // ============ REPORTS & ANALYTICS ============
    Route::get('/reportsAnalytics', function () {
        return view('admin.reportsAnalytics');
    })->name('reportsAnalytics');
    
    // ============ SETTINGS ROUTES ============
    Route::get('/general', function () {
        return view('admin.settingsPudho.general');
    })->name('general');
    
    Route::get('/security', function () {
        return view('admin.settingsPudho.security');
    })->name('security');
    
    Route::get('/logs', function () {
        return view('admin.settingsPudho.logs');
    })->name('logs');
    
    Route::get('/notifications', function () {
        return view('admin.settingsPudho.notifications');
    })->name('notifications');
    
    Route::get('/help', function () {
        return view('admin.settingsPudho.help');
    })->name('help');
});

/*
|--------------------------------------------------------------------------
| Editor Routes
|--------------------------------------------------------------------------
*/
Route::prefix('editor')->name('editor.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EditorController::class, 'dashboard'])->name('dashboard');
    Route::get('/editorDashboard', function () {
        return view('editor.editorDashboard');
    })->name('editorDashboard');
    Route::get('/editor_dashboard', [EditorController::class, 'dashboard'])->name('editor_dashboard.direct');
});

/*
|--------------------------------------------------------------------------
| Legacy Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/welcome', function () {
    Auth::logout();
    return redirect('/');
})->name('welcome');

// Fallback
Route::fallback(function () {
    return redirect()->route('admin.login');
});