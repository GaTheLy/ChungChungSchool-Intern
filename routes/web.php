<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeachController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\YearProgramController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeroomController;



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
Route::delete('/subject-edit/{userId}/{subjectId}/criteriaPYP/{criteriaId}', [SubjectController::class, 'deleteCritPYP'])
    ->middleware(['auth', 'verified'])->name('subject-edit-criteriaPYP.delete');
Route::delete('/subject-edit/{userId}/{subjectId}/criteria/{criteriaId}', [SubjectController::class, 'deleteCritMYP'])
    ->middleware(['auth', 'verified'])->name('subject-edit-criteriaMYP.delete');
// delete subject
Route::post('/subject-delete/{userId}/{subjectId}', [SubjectController::class, 'delete'])
->middleware(['auth', 'verified'])->name('subject.delete');
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


//admin route profile
Route::get('/profile-admin/{userId}/{teacherId}', [TeachController::class, 'profileAdmin'])
->middleware(['auth', 'verified'])->name('profile-admin.show');
Route::post('/profile-admin-edit/{userId}/{teacherId}', [TeachController::class, 'editProfileAdmin'])
->middleware(['auth', 'verified'])->name('profile-admin.edit');

//teacher route profile
// Route::get('/profile/{userId}/{teacherId}', [TeachController::class, 'profile'])
// ->middleware(['auth', 'verified'])->name('profile.show');
// Route::post('/profile-edit/{userId}/{teacherId}', [TeachController::class, 'editProfileAdmin'])
// ->middleware(['auth', 'verified'])->name('profile.edit');

// admin route report custom
Route::get('/pyp-report-custom/{userId}', [ReportController::class, 'pypCustom'])
->middleware(['auth', 'verified'])->name('pypCustom.show');
Route::post('/pyp-report-custom-edit/{userId}', [ReportController::class, 'editPypCustom'])
->middleware(['auth', 'verified'])->name('pypCustom.edit');

Route::get('/myp-report-custom/{userId}', [ReportController::class, 'mypCustom'])
->middleware(['auth', 'verified'])->name('mypCustom.show');





// admin route || student crud
Route::get('/student/{userId}', [StudentController::class, 'student'])
->middleware(['auth', 'verified'])->name('student');
// show form
Route::get('/student-add/{userId}', [StudentController::class, 'add'])
->middleware(['auth', 'verified'])->name('student-add.index');
// submit form
Route::post('/student-submit/{userId}', [StudentController::class, 'submit'])
->middleware(['auth', 'verified'])->name('student-add.submit');
//detail student
Route::get('/student/{userId}/{studentId}', [StudentController::class, 'detail'])
->middleware(['auth', 'verified'])->name('student.detail');
//edit student
Route::get('/student-edit/{userId}/{studentId}', [StudentController::class, 'edit'])
->middleware(['auth', 'verified'])->name('student.edit');
Route::post('/student-edit-submit/{userId}/{studentId}', [StudentController::class, 'editSubmit'])
->middleware(['auth', 'verified'])->name('student-edit.submit');
// delete subject
Route::post('/student-delete/{userId}/{studentId}', [StudentController::class, 'delete'])
->middleware(['auth', 'verified'])->name('student.delete');




// admin route || year program crud
Route::get('/year-program/{userId}', [YearProgramController::class, 'yearProgram'])
->middleware(['auth', 'verified'])->name('yearProgram');
Route::post('/year-program-add/{userId}', [YearProgramController::class, 'add'])
->middleware(['auth', 'verified'])->name('yearProgram-add.index');
Route::post('/year-program-add-bound/{userId}/{ypId}', [YearProgramController::class, 'boundaries'])
->middleware(['auth', 'verified'])->name('yearProgram-add.boundariesMYP');

Route::post('/year-program-addPYP/{userId}', [YearProgramController::class, 'addPYP'])
->middleware(['auth', 'verified'])->name('yearProgram-add.indexPYP');

Route::post('/year-program-add-unit/{userId}/{ypId}', [YearProgramController::class, 'addUnit'])
->middleware(['auth', 'verified'])->name('yearProgram-add.unitPYP');
Route::post('/year-program-add-atl/{userId}/{ypId}', [YearProgramController::class, 'addATL'])
->middleware(['auth', 'verified'])->name('yearProgram-add.atlPYP');

Route::post('/year-program-add-subject/{userId}/{ypId}', [YearProgramController::class, 'addSubject'])
->middleware(['auth', 'verified'])->name('yearProgram-add.subject');
Route::post('/year-program-add-subjectPYP/{userId}/{ypId}', [YearProgramController::class, 'addSubjectPYP'])
->middleware(['auth', 'verified'])->name('yearProgram-add.subjectPYP');

Route::post('/year-program-add-class/{userId}/{ypId}', [YearProgramController::class, 'addClass'])
->middleware(['auth', 'verified'])->name('yearProgram-add.class');
Route::post('/year-program-add-classPYP/{userId}/{ypId}', [YearProgramController::class, 'addClassPYP'])
->middleware(['auth', 'verified'])->name('yearProgram-add.classPYP');




//class make route
Route::get('/class-page/{userId}', [ClassController::class, 'class'])
->middleware(['auth', 'verified'])->name('class');
// show form
Route::get('/class-add/{userId}', [ClassController::class, 'add'])
->middleware(['auth', 'verified'])->name('class-add.index');
// submit form
Route::post('/class-submit/{userId}', [ClassController::class, 'submit'])
->middleware(['auth', 'verified'])->name('class-add.submit');
//detail class
Route::get('/class-detail/{userId}/{classId}', [ClassController::class, 'detail'])
->middleware(['auth', 'verified'])->name('class.detail');
//edit class
Route::get('/class-edit/{userId}/{classId}', [ClassController::class, 'edit'])
->middleware(['auth', 'verified'])->name('class.edit');

Route::post('/class-delete-student/{userId}/{classId}/{studentId}', [ClassController::class, 'deleteStudent'])
    ->middleware(['auth', 'verified'])
    ->name('class.delete.student');

Route::post('/class-edit-submit/{userId}/{classId}', [ClassController::class, 'editSubmit'])
    ->middleware(['auth', 'verified'])
    ->name('class.edit.submit');

    // delete class
    Route::post('/class-delete/{userId}/{classId}', [ClassController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('class.delete');



    // profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Class/ Homeroom
Route::get('/class/{id}', [ClassController::class, 'show'])->name('class.show');

Route::get('/class-myp/{id}', [ClassController::class, 'showMyp'])->name('class.show.myp');

//Subject -> Grading
Route::get('/subject/{teacher_id}/{sub_id}/{class_id}', [TeachController::class, 'subjectDetail'])->name('subject.show');

Route::get('/subject-teacher/{teacherId}/{subjectId}/{classId}/{studentId}/grade', [TeachController::class, 'gradeStudent'])->name('subject.grade');

Route::post('/subject/grade/save', [TeachController::class, 'saveGrade'])->name('subject.grade.save');

//Grading (MYP)
Route::get('/subject-teacher-myp/{teacherId}/{subjectId}/{classId}/{studentId}/grade', [TeachController::class, 'gradeStudentMyp'])->name('subject.grade.myp');

Route::post('/subject-myp/grade/save', [TeachController::class, 'saveGradeMyp'])->name('subject.grade.myp.save');

// Attendance
Route::post('/attendance/save', [TeachController::class, 'saveAttendance'])->name('attendance.save.pyp');

Route::get('/attendance/{studentId}', [ClassController::class, 'getAttendance']);

Route::post('/attendance-myp/save', [TeachController::class, 'saveAttendanceMyp'])->name('attendance.save.myp');

Route::get('/attendance-myp/{studentId}', [ClassController::class, 'getAttendanceMyp']);

// New Attendance
Route::post('/new-attendance/save', [HomeroomController::class, 'savePyp'])->name('new.attendance.save.pyp');

Route::post('/attendance-by-date/{classId}', [HomeroomController::class, 'getAttendanceByDate']);

Route::get('/students-by-class/{classId}', [HomeroomController::class, 'getStudentsByClass']);


// Unit Progress
Route::post('/save-unit-progress', [HomeroomController::class, 'saveUnitProg'])->name('homeroom.saveUnitProg');

Route::get('/unit-progress/{unitId}/{classId}', [HomeroomController::class, 'getUnitProgress']);

// ATL
Route::post('/new-atl-progress/save', [HomeroomController::class, 'saveAtlProg']);

Route::get('/atl-progress/{atlId}/{classId}', [HomeroomController::class, 'getAtlProgress']);

// Homeroom Teacher's Comment
Route::post('/save-homeroom-comments', [HomeroomController::class, 'saveComments']);


// Report Preview
Route::get('/report-myp/{studentId}', [ReportController::class, 'previewReport'])->name('report.myp');

Route::get('/report-pyp/{studentId}', [ReportController::class, 'previewReportPyp'])->name('report.pyp');

require __DIR__.'/auth.php';

