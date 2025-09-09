<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLogsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RegularUserAuthController;
use App\Http\Controllers\RegularUserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\RegularUserFileController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminFileController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\RegularUser\ContactController;
use App\Http\Controllers\RegularUser\Auth\ForgotPasswordController;
use App\Http\Controllers\RegularUser\Auth\ResetPasswordController;


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
    return view('landingpage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::prefix('files')->name('files.')->group(function () {
        Route::get('/', [AdminFileController::class, 'index'])->name('index');
        Route::get('/create', [AdminFileController::class, 'create'])->name('create');
        Route::post('/store', [AdminFileController::class, 'store'])->name('store');
        Route::get('/download/{id}', [AdminFileController::class, 'download'])->name('download');
        Route::delete('/{id}', [AdminFileController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('logs')->name('logs.')->group(function () {
        Route::get('/', [AdminLogsController::class, 'index'])->name('index');
        Route::get('/reports', [AdminLogsController::class, 'reports'])->name('reports');
        Route::get('/export', [AdminLogsController::class, 'exportLogsToPDF'])->name('export');
        Route::delete('/clear', [AdminLogsController::class, 'clearLogs'])->name('clear');
    });

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [AdminReportController::class, 'index'])->name('index');

        Route::prefix('file-transfer')->name('file_transfer.')->group(function () {
            Route::get('/', [AdminReportController::class, 'fileTransferReport'])->name('index');
            Route::get('/export', [AdminReportController::class, 'exportFileTransferReportToPDF'])->name('export');
            Route::get('/filter', [AdminReportController::class, 'filterFileTransferReport'])->name('filter');
        });

        Route::prefix('storage-usage')->name('storage_usage.')->group(function () {
            Route::get('/', [AdminReportController::class, 'storageUsageReport'])->name('index');
            Route::get('/export', [AdminReportController::class, 'exportStorageUsageReportToPDF'])->name('export');
            Route::get('/filter', [AdminReportController::class, 'filterStorageUsageReport'])->name('filter');
            Route::get('/export/pdf', [ReportsController::class, 'exportStorageUsageReportToPDF'])->name('export.pdf');
        });
    });

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('users', UserController::class)->except(['show']);
});

Route::prefix('regular_user')->name('regular_users.')->group(function () {
    
    Route::get('/register', [RegularUserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegularUserAuthController::class, 'register']);

    Route::get('/login', [RegularUserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [RegularUserAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [RegularUserAuthController::class, 'logout'])->name('logout');

    Route::post('/update_profile_image', [RegularUserAuthController::class, 'updateProfileImage'])->name('update_profile_image');

    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // ✅ Regular User Pages and Actions (Publicly accessible now)
    Route::view('/dashboard', 'regular_users.dashboard')->name('dashboard');
    Route::get('/download-files', [RegularUserFileController::class, 'index'])->name('download_files');
    Route::get('/download-files/download/{id}', [RegularUserFileController::class, 'download'])->name('files.download');

    Route::view('/home', 'regular_users.home')->name('home');
    Route::view('/key-features', 'regular_users.key_features')->name('key_features');
    Route::view('/faqs', 'regular_users.faqs')->name('faqs');
    Route::view('/testimonials', 'regular_users.testimonials')->name('testimonials');
    Route::view('/about-us', 'regular_users.about_us')->name('about_us');
    Route::view('/contact-us', 'regular_users.contact_us')->name('contact_us');

    Route::post('/contact', [RegularUserController::class, 'submitContact'])->name('contact.submit');
    Route::post('/contact/alt', [ContactController::class, 'submit'])->name('contact.submit.alt');
});


require __DIR__.'/auth.php';
