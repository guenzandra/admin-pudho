<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Editor\EditorController;

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

    Route::get('/check-auth', function () {
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
    Route::get('/second_dashboard', function () {
        return view('admin.second_dashboard');
    })->name('second_dashboard');

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

    // ============ CMS ROUTES (Post Drop-down) ============

    //Posts main page
    Route::get('/post', function () {
        return view('admin.post');
    })->name('post');

    // All Posts page
    Route::get('/allpost', function () {
        return view('admin.cms-dropdown.allpost');
    })->name('allpost');

    // Add Post - both view and controller routes
    Route::get('/addpost', [PostController::class, 'create'])->name('addpost');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/upload-media', [PostController::class, 'uploadMedia'])->name('posts.upload-media');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');
    Route::get('/categories/dropdown', [CategoryController::class, 'getForDropdown'])->name('categories.dropdown');

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

    // ============ ANTI-SQUATTING DROPDOWN ROUTES ============
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

    // ============ MESSAGES DROPDOWN ROUTES ============
    Route::get('/inbox', function () {
        return view('admin.messages.inbox');
    })->name('inbox');

    Route::get('/sent', function () {
        return view('admin.messages.sent');
    })->name('sent');

    Route::get('/archived', function () {
        return view('admin.messages.archived');
    })->name('archived');

    // ============ FAQS DROPDOWN ROUTES ============
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

    // ============ SETTINGS DROPDOWN ROUTES ============
    Route::get('/general', function () {
        return view('admin.settingPudho.general');
    })->name('general');

    Route::get('/security', function () {
        return view('admin.settingPudho.security');
    })->name('security');

    Route::get('/logs', function () {
        return view('admin.settingPudho.logs');
    })->name('logs');

    Route::get('/notifications', function () {
        return view('admin.settingPudho.notifications');
    })->name('notifications');

    Route::get('/help', function () {
        return view('admin.settingPudho.help');
    })->name('help');
});

/*
|--------------------------------------------------------------------------
| Second Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('second_admin')->name('second_admin.')->middleware(['auth'])->group(function () {
    Route::get('/sec_dashboard', function () {
        return view('second_admin.sec_dashboard');
    })->name('sec_dashboard');
});

/*
|--------------------------------------------------------------------------
| EDITOR ROUTES (Consolidated)
|--------------------------------------------------------------------------
*/
Route::prefix('editor')->name('editor.')->middleware(['auth'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [EditorController::class, 'dashboard'])->name('dashboard');
    Route::get('/editorDashboard', function () {
        return view('editor.editorDashboard');
    })->name('editorDashboard');
    Route::get('/editor_dashboard', [EditorController::class, 'dashboard'])->name('editor_dashboard.direct');

    // Announcements management
    Route::get('/announcements', function () {
        return view('editor.announcements');
    })->name('announcements');

    // News management
    Route::get('/news', function () {
        return view('editor.news');
    })->name('news');

    // Vision, Mission & Core Values management
    Route::get('/vision-mission-values', function () {
        return view('editor.vision-mission-values');
    })->name('vision-mission-values');

    // Organizational Structure management
    Route::get('/organizational-structure', function () {
        return view('editor.organizational-structure');
    })->name('organizational-structure');

    // District Offices management
    Route::get('/district-offices', function () {
        return view('editor.district-offices');
    })->name('district-offices');

    // Affiliated Offices management
    Route::get('/affiliated-offices', function () {
        return view('editor.affiliated-offices');
    })->name('affiliated-offices');

    // Citizen's Charter management
    Route::get('/citizens-charter', function () {
        return view('editor.citizens-charter');
    })->name('citizens-charter');

    // Manage Services
    Route::get('/manage-services', function () {
        return view('editor.manage-services');
    })->name('manage-services');

    // Manage FAQs
    Route::get('/manage-faqs', function () {
        return view('editor.manage-faqs');
    })->name('manage-faqs');

    // FAQ Categories
    Route::get('/faq-categories', function () {
        return view('editor.faq-categories');
    })->name('faq-categories');

    // Downloadable Forms
    Route::get('/downloadable-forms', function () {
        return view('editor.downloadable-forms');
    })->name('downloadable-forms');

    // Form Categories
    Route::get('/form-categories', function () {
        return view('editor.form-categories');
    })->name('form-categories');

    // Images
    Route::get('/images', function () {
        return view('editor.images');
    })->name('images');

    // Documents
    Route::get('/documents', function () {
        return view('editor.documents');
    })->name('documents');

    // Settings - Notifications
    Route::get('/settings/notifications', function () {
        return view('editor.settings.notifications');
    })->name('settings.notifications');

    // Settings - Content Preferences
    Route::get('/settings/content-preferences', function () {
        return view('editor.settings.content-preferences');
    })->name('settings.content-preferences');

    // Settings - Help/User Guide
    Route::get('/settings/help-guide', function () {
        return view('editor.settings.help-guide');
    })->name('settings.help-guide');
});

/*
|--------------------------------------------------------------------------
| Legacy Routes (Maintained for backward compatibility)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/welcome', function () {
    Auth::logout();
    return redirect('/');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
*/

// Database connection test
Route::get('/test-db-connection', function () {
    try {
        // Test first database (pudho_db)
        $firstDB = DB::connection('mysql')->getPdo();

        // Test second database (test_reports)
        $secondDB = DB::connection('mysql_second')->getPdo();

        return response()->json([
            'status' => 'success',
            'message' => 'Both databases connected successfully!',
            'first_db' => 'pudho_db is connected',
            'second_db' => 'test_reports is connected'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
});

// Test reports route
Route::get('/test-reports', function () {
    try {
        // Try to get reports from second database
        $reports = DB::connection('mysql_second')
            ->table('reports')
            ->get();

        return response()->json([
            'status' => 'success',
            'total_reports' => $reports->count(),
            'reports' => $reports
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
});

/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return redirect()->route('admin.login');
});
