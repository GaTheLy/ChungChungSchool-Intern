<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeachController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;


// teacher route
Route::get('/subject-teacher-detail', function () {
    return view('subject-detail');
});
Route::get('/subject-teacher-detail-grade', function () {
    return view('subject-detail-grade');
});
Route::get('/homeroom-teacher', function () {
    return view('homeroom-teacher');
});

Route::get('/homeroom-teacher-report-preview-myp', function () {
    return view('ht-myp-report');
});



// pyp
Route::get('/subject-teacher-detail-pyp', function () {
    return view('sub-detail-pyp');
});
Route::get('/subject-teacher-detail-grade-pyp', function () {
    return view('sub-detail-pyp-grade');
});
Route::get('/homeroom-teacher-pyp', function () {
    return view('homeroom-teach-pyp');
});

Route::get('/homeroom-teacher-report-preview-pyp', function () {
    return view('ht-pyp-report');
});





// admin route
Route::get('/custom-report-pyp', function () {
    return view('admin-custom-report/custom-pyp');
});

Route::get('/custom-report-myp', function () {
    return view('admin-custom-report/custom-myp');
});
Route::get('/subject-admin-add', function () {
    return view('subject-admin-add');
});

Route::get('/teacher-admin', function () {
    return view('teacher-admin');
});
Route::get('/teacher-admin-add', function () {
    return view('teacher-admin-add');
});

Route::get('/student-admin', function () {
    return view('student-admin');
});
Route::get('/student-admin-add', function () {
    return view('student-admin-add');
});

Route::get('/year-program-admin', function () {
    return view('yp-admin');
});
Route::get('/year-program-admin-add', function () {
    return view('yp-admin-add');
});

//dashroute all
Route::get('/dashboard/{userId}', [TeachController::class, 'show'])
->middleware(['auth', 'verified'])->name('dashboard');

// subject route pyp done || soon myp n admin
Route::get('/subject/{userId}', [TeachController::class, 'subjects'])
->middleware(['auth', 'verified'])->name('subject');

// homeroom route pyp done || soon myp n admin
Route::get('/homeroom/{userId}', [TeachController::class, 'homeroom'])
->middleware(['auth', 'verified'])->name('homeroom');


// admin route || teacher crud
Route::get('/teacher/{userId}', [TeachController::class, 'teacher'])
->middleware(['auth', 'verified'])->name('teacher');

// admin route || student crud
Route::get('/student/{userId}', [StudentController::class, 'student'])
->middleware(['auth', 'verified'])->name('student');

// admin route || year program crud
Route::get('/year-program/{userId}', [TeachController::class, 'yearProgram'])
->middleware(['auth', 'verified'])->name('yearProgram');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/class/{id}', [ClassController::class, 'show'])->name('class.show');

Route::get('/subject/{id}/{sub_id}', [TeachController::class, 'showSubjectClasses'])->name('subject.show');

require __DIR__.'/auth.php';

