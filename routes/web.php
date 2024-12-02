<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Buildings\BuildingController;
use App\Http\Controllers\Buildings\RoleController;
use App\Http\Controllers\Floor\FloorController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
    return view('welcome');
});
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['role:director'])->group(function () {
    Route::resource('buildings',BuildingController::class)
    ->only(['index', 'create', 'store']);
    // routes/web.php
    Route::get('/assign-roles', [RoleController::class, 'showAssignRoleForm'])->name('assign.roles.form');
    Route::post('/assign-roles', [RoleController::class, 'assignRole'])->name('assign.roles');

    });

    Route::middleware(['role:building_manager'])->group(function () {
    Route::resource('floors',FloorController::class)
    ->only(['index', 'create', 'store']);
    });


//     Route::middleware(['role:building_manager'])->group(function () {
//     Route::get('/building_manager/dashboard', function () {
//         return view('BuildingManafer.dashboard');
//     })->name('building_manager.dashboard');
// });
    Route::get('/floor_manager/dashboard', function () {
        return 'Hello from Floor Manager Dashboard';
    })->name('floor_manager.dashboard');

    Route::get('/student/dashboard', function () {
        return 'Hello from Student Dashboard';
    })->name('student.dashboard');
});


require __DIR__.'/auth.php';
