<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace'=>'Razan\School\Http\Livewire'],function(){

    Route::get('/', function () {
        return view('auth.login');
    });
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('teachers', TeacherLivewire::class)->name('teacher');
    Route::get('students', StudentLivewire::class)->name('students');
    Route::get('courses', CourseLivewire::class)->name('courses');
    Route::get('teachercourses', TeacherdashLivewire::class)->name('course');
    Route::get('studentCourses', StudentCoursesLivewire::class)->name('studentCourses');
    Route::get('studentTask', StudentTaskLivewire::class)->name('studentTask');
    });


