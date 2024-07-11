<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeachController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;






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
Route::get('/subject/{userId}', [SubjectController::class, 'subjects'])
->middleware(['auth', 'verified'])->name('subject');

// subject route admin
// show form
Route::get('/subject-add/{userId}', [SubjectController::class, 'subjectAddPage'])
->middleware(['auth', 'verified'])->name('subject-add.index');
// submit form
Route::post('/subject-submit/{userId}', [SubjectController::class, 'submit'])
->middleware(['auth', 'verified'])->name('subject-add.submit');
//detail subject
Route::get('/subject/{userId}/{subjectId}', [SubjectController::class, 'detail'])
->middleware(['auth', 'verified'])->name('subject.detail');
//edit subject
Route::get('/subject-edit/{userId}/{subjectId}', [SubjectController::class, 'edit'])
->middleware(['auth', 'verified'])->name('subject.edit');
Route::post('/subject-edit-submit/{userId}/{subjectId}', [SubjectController::class, 'editSubmit'])
->middleware(['auth', 'verified'])->name('subject-edit.submit');
// delete subject
Route::post('/subject-delete/{userId}/{subjectId}', [SubjectController::class, 'delete'])
->middleware(['auth', 'verified'])->name('subject.delete');


// homeroom route pyp done || soon myp n admin
Route::get('/homeroom/{userId}', [TeachController::class, 'homeroom'])
->middleware(['auth', 'verified'])->name('homeroom');


// admin route || teacher crud
Route::get('/teacher/{userId}', [TeachController::class, 'teacher'])
->middleware(['auth', 'verified'])->name('teacher');
// show form
Route::get('/teacher-add/{userId}', [TeachController::class, 'add'])
->middleware(['auth', 'verified'])->name('teacher-add.index');
// submit form
Route::post('/teacher-submit/{userId}', [TeachController::class, 'submit'])
->middleware(['auth', 'verified'])->name('teacher-add.submit');
//detail teacher
Route::get('/teacher/{userId}/{teacherId}', [TeachController::class, 'detail'])
->middleware(['auth', 'verified'])->name('teacher.detail');
//edit teacher
Route::get('/teacher-edit/{userId}/{teacherId}', [TeachController::class, 'edit'])
->middleware(['auth', 'verified'])->name('teacher.edit');
Route::post('/teacher-edit-submit/{userId}/{teacherId}', [TeachController::class, 'editSubmit'])
->middleware(['auth', 'verified'])->name('teacher-edit.submit');
// delete subject
Route::post('/teacher-delete/{userId}/{teacherId}', [TeachController::class, 'delete'])
->middleware(['auth', 'verified'])->name('teacher.delete');








// admin route || student crud
Route::get('/student/{userId}', [StudentController::class, 'student'])
->middleware(['auth', 'verified'])->name('student');

// Route::get('/student-add/{userId}', [SubjectController::class, 'studentAddPage'])
// ->middleware(['auth', 'verified'])->name('student-add.index');

// admin route || year program crud
Route::get('/year-program/{userId}', [TeachController::class, 'yearProgram'])
->middleware(['auth', 'verified'])->name('yearProgram');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/class/{id}', [ClassController::class, 'show'])->name('class.show');

Route::get('/subject/{teacher_id}/{sub_id}/{class_id}', [TeachController::class, 'subjectDetail'])->name('subject.show');

Route::get('/subject-teacher/{teacherId}/{subjectId}/{classId}/{studentId}/grade', [TeachController::class, 'gradeStudent'])->name('subject.grade');

Route::post('/subject/grade/save', [TeachController::class, 'saveGrade'])->name('subject.grade.save');

require __DIR__.'/auth.php';

