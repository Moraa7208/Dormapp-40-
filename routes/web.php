<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Buildings\BuildingController;
use App\Http\Controllers\Buildings\RoleController as BuildingsRoleController;;
use App\Http\Controllers\Floor\RoleController as FloorRoleController;
use App\Http\Controllers\Floor\FloorController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Room\AssignmentReviewController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Assignment\AssignmentController;
use App\Http\Controllers\Assignment\StudentAssignmentController;
use App\Http\Controllers\Assignment\ManagerAssignmentController;
use App\Http\Controllers\StudentController;



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
        Route::get('/buildings/assign-roles', [BuildingsRoleController::class, 'showAssignRoleForm'])->name('buildings.assign.roles.form');
        Route::post('/buildings/assign-roles', [BuildingsRoleController::class, 'assignRole'])->name('buildings.assign.roles');
    });

    Route::middleware(['role:building_manager'])->group(function () {
        Route::resource('floors',FloorController::class)
        ->only(['index', 'create', 'store']);
        Route::get('/floors/assign-roles', [FloorRoleController::class, 'showAssignRoleForm'])->name('floor.assign.roles.form');
        Route::post('/floors/assign-roles', [FloorRoleController::class, 'assignRole'])->name('floor.assign.roles');
    });

    Route::middleware(['role:floor_manager'])->group(function () {
        // Route::get('assignments/{assignmentId}/review', [ManagerAssignmentController::class, 'create'])->name('reviews.create');
        // Route::post('assignments/{assignmentId}/review', [ManagerAssignmentController::class, 'store'])->name('reviews.store');

        Route::resource('assignmentreviews', AssignmentReviewController::class);

        Route::resource('rooms',RoomController::class)
        ->only(['index', 'create', 'store', 'show']);

        Route::get('rooms/assign-students', [RoomController::class, 'assignStudentsForm'])->name('rooms.assign-students.form');
        Route::post('rooms/assign-students', [RoomController::class, 'assignStudents'])->name('rooms.assign-students');
    });

    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/room', [AssignmentController::class, 'assignCleaningTask'])->name('student.room');
        Route::get('/student/room/{assignmentId}/upload-photos-form', [StudentAssignmentController::class, 'showUploadForm'])->name('student.upload_photos_form');
        Route::post('/assignments/{assignmentId}/upload-photos', [StudentAssignmentController::class, 'uploadCleaningPhotos'])->name('student.upload_photos');
    });
});

require __DIR__.'/auth.php';
