<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\PublicReportController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\admin\PerkarasController;
use App\Http\Controllers\admin\ContactUsController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

// Public routes
Route::get('/hubungi', [PublicReportController::class, 'index'])->name('public.report.index');
Route::post('/hubungi', [PublicReportController::class, 'store'])->name('public.report.store');

Auth::routes();
Route::middleware(['auth'])->group(
    function () {
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(DashboardController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        // users
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(UsersController::class)->group(function () {
                Route::get('/users', 'index')->name('users.index');
                Route::get('/users/create', 'create')->name('users.create');
                Route::post('/users', 'store')->name('users.store');
                Route::get('/users/{id}/edit', 'edit')->name('users.edit');
                Route::put('/users/{id}', 'update')->name('users.update');
                Route::delete('/users/{id}', 'destroy')->name('users.destroy');
                Route::get('/users/polsek/{polres_id}', 'getPolsek')->name('users.polsek');
                Route::get('/users/{id}', 'show')->name('users.show');
            });
        });

        // roles
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(RolesController::class)->group(function () {
                Route::get('/roles', 'index')->name('roles.index');
            });
        });

        // perkaras
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(PerkarasController::class)->group(function () {
                Route::get('/perkaras', 'index')->name('perkaras.index');
                Route::get('/perkaras/print', 'indexCetak')->name('perkaras.index.print');
                Route::get('/perkaras/create', 'create')->name('perkaras.create');
                Route::post('/perkaras', 'store')->name('perkaras.store');
                Route::get('/perkaras/datatable', 'datatable')->name('perkaras.datatable');
                Route::get('/perkaras/{id}/edit', 'edit')->name('perkaras.edit');
                Route::put('/perkaras/{id}', 'update')->name('perkaras.update');
                Route::delete('/perkaras/{id}', 'destroy')->name('perkaras.destroy');
                Route::get('/perkaras/{id}', 'show')->name('perkaras.show');
            });
        });

        // contact-us
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(ContactUsController::class)->group(function () {
                Route::get('/contact-us', 'index')->name('contact-us.index');
            });
        });

        // about-us
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(AboutUsController::class)->group(function () {
                Route::get('/about-us', 'index')->name('about-us.index');
                Route::get('/about-us/create', 'create')->name('about-us.create');
                Route::post('/about-us', 'store')->name('about-us.store');
                Route::get('/about-us/{id}/edit', 'edit')->name('about-us.edit');
                Route::put('/about-us/{id}', 'update')->name('about-us.update');
                Route::delete('/about-us/{id}', 'destroy')->name('about-us.destroy');
                Route::get('/about-us/{id}', 'show')->name('about-us.show');
            });
        });

        // public-reports
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(App\Http\Controllers\admin\PublicReportsController::class)->group(function () {
                Route::get('/public-reports', 'index')->name('public-reports.index');
                // datatable
                Route::get('/public-reports/datatable', 'datatable')->name('public-reports.datatable');
                Route::get('/public-reports/{id}', 'show')->name('public-reports.show');
                Route::delete('/public-reports/{id}', 'destroy')->name('public-reports.destroy');
            });
        });
    }
);
