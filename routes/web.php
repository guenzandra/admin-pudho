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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Editor\AnnouncementController;

/*
|--------------------------------------------------------------------------
| Landing Page Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('index.IPages.iabout');
})->name('iabout');

Route::get('/services', function () {
    return view('index.IPages.iservices');
})->name('iservices');

Route::get('/citizens-charter', function () {
    return view('index.IPages.citizenscharter');
})->name('citizenscharter');

Route::get('/dforms', function () {
    return view('index.IPages.dforms');
})->name('dforms');

Route::get('/faqs', function () {
    return view('index.IPages.faqs');
})->name('landing.faqs');

Route::get('/news', [LandingController::class, 'news'])->name('landing.news');
Route::get('/news/{id}', [LandingController::class, 'newsShow'])->name('landing.news.show');

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
                    'id'       => $user->user_id,
                    'name'     => $user->first_name . ' ' . $user->last_name,
                    'email'    => $user->email,
                    'role'     => $user->role_name,
                    'role_no'  => $user->role_no,
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

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/second_dashboard', function () {
        return view('admin.second_dashboard');
    })->name('second_dashboard');

    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');

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
    Route::get('/post', function () {
        return view('admin.post');
    })->name('post');

    Route::get('/allpost', function () {
        return view('admin.cms-dropdown.allpost');
    })->name('allpost');

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

    Route::get('/media', function () {
        return view('admin.cms-dropdown.media');
    })->name('media');

    // ============ USER MANAGEMENT ============
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::patch('/users/{id}/status', [UserController::class, 'updateStatus'])->name('users.status');
    Route::delete('/users/{id}/archive', [UserController::class, 'archive'])->name('users.archive');
    Route::post('/generate-username', [UserController::class, 'generateUsername'])->name('users.generate-username');

    Route::get('/usermanagement', function () {
        return view('admin.usermanagement');
    })->name('usermanagement');

    // ============ ARCHIVE ROUTES ============
    Route::get('/archived-users', [UserController::class, 'getArchived'])->name('users.archived');
    Route::post('/archived-users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/archived-users/{id}', [UserController::class, 'permanentDelete'])->name('users.permanent-delete');
    Route::delete('/recycle-bin/empty', [UserController::class, 'emptyRecycleBin'])->name('users.empty-recycle-bin');

    // ============ ANTI-SQUATTING ============
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

    // ============ MESSAGES ============
    Route::get('/messages', function () {
        return view('admin.messages');
    })->name('messages');

    // ============ FAQS ============
    Route::get('/faqs', function () {
        return view('admin.faqs');
    })->name('faqs');

    // ============ REPORTS & ANALYTICS ============
    Route::get('/reportsAnalytics', function () {
        return view('admin.reportsAnalytics');
    })->name('reportsAnalytics');

    // ============ SETTINGS ============
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
| Editor Routes
|--------------------------------------------------------------------------
*/
Route::prefix('editor')->name('editor.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EditorController::class, 'dashboard'])->name('dashboard');
    Route::get('/editorDashboard', function () {
        return view('editor.editorDashboard');
    })->name('editorDashboard');
    Route::get('/editor_dashboard', [EditorController::class, 'dashboard'])->name('editor_dashboard.direct');

    Route::get('/announcements', function () {
        return view('editor.announcements');
    })->name('announcements');

    Route::get('/news', function () {
        return view('editor.news');
    })->name('news');

    Route::get('/vision-mission-values', function () {
        return view('editor.vision-mission-values');
    })->name('vision-mission-values');

    Route::get('/organizational-structure', function () {
        return view('editor.organizational-structure');
    })->name('organizational-structure');

    Route::get('/district-offices', function () {
        return view('editor.district-offices');
    })->name('district-offices');

    Route::get('/affiliated-offices', function () {
        return view('editor.affiliated-offices');
    })->name('affiliated-offices');

    Route::get('/citizens-charter', function () {
        return view('editor.citizens-charter');
    })->name('citizens-charter');

    Route::get('/manage-services', function () {
        return view('editor.manage-services');
    })->name('manage-services');

    Route::get('/manage-faqs', function () {
        return view('editor.manage-faqs');
    })->name('manage-faqs');

    Route::get('/faq-categories', function () {
        return view('editor.faq-categories');
    })->name('faq-categories');

    Route::get('/downloadable-forms', function () {
        return view('editor.downloadable-forms');
    })->name('downloadable-forms');

    Route::get('/form-categories', function () {
        return view('editor.form-categories');
    })->name('form-categories');

    Route::get('/images', function () {
        return view('editor.images');
    })->name('images');

    Route::get('/documents', function () {
        return view('editor.documents');
    })->name('documents');

    Route::get('/settings/notifications', function () {
        return view('editor.settings.notifications');
    })->name('settings.notifications');

    Route::get('/settings/content-preferences', function () {
        return view('editor.settings.content-preferences');
    })->name('settings.content-preferences');

    Route::get('/settings/help-guide', function () {
        return view('editor.settings.help-guide');
    })->name('settings.help-guide');

    //Settings - General Settings
    Route::get('/settings/general-settings', function () {
        return view('editor.settings.general-settings');
    })->name('settings.general-settings');
});

// Editor Announcement Routes
Route::middleware(['auth'])->prefix('editor')->group(function () {
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('editor.announcements');
    Route::get('/announcements/data', [AnnouncementController::class, 'getData'])->name('editor.announcements.data');
    Route::get('/announcements/{id}', [AnnouncementController::class, 'show'])->name('editor.announcements.show');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('editor.announcements.store');
    Route::put('/announcements/{id}', [AnnouncementController::class, 'update'])->name('editor.announcements.update');
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('editor.announcements.destroy');
    Route::patch('/announcements/{id}/toggle-status', [AnnouncementController::class, 'toggleStatus'])->name('editor.announcements.toggle-status');
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

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
*/
Route::get('/test-db-connection', function () {
    try {
        $firstDB = DB::connection('mysql')->getPdo();
        $secondDB = DB::connection('mysql_second')->getPdo();
        return response()->json([
            'status'    => 'success',
            'message'   => 'Both databases connected successfully!',
            'first_db'  => 'pudho_db is connected',
            'second_db' => 'test_reports is connected'
        ]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
});

Route::get('/test-reports', function () {
    try {
        $reports = DB::connection('mysql_second')->table('reports')->get();
        return response()->json([
            'status'        => 'success',
            'total_reports' => $reports->count(),
            'reports'       => $reports
        ]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
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