<?php

use Illuminate\Support\Facades\Route;


// teacher route
Route::get('/', function () {
    return view('login-teacher');
});


// myp route
Route::get('/dash', function () {
    return view('dash-teacher');
});

Route::get('/subject-teacher', function () {
    return view('subject-teacher');
});
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


// myp route
Route::get('/dash-pyp', function () {
    return view('dash-teacher-pyp');
});

Route::get('/subject-teacher-pyp', function () {
    return view('sub-teach-pyp');
});
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
Route::get('/admin', function () {
    return view('login-admin');
});
Route::get('/admin-dash', function () {
    return view('dash-admin');
});
Route::get('/subject-admin', function () {
    return view('subject-admin');
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