<?php

use App\Http\Controllers\TeacherDashboardController;
use App\Models\student;
use App\Models\teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {

            // 5:54 video 49
            $ids = teachers::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
            // 13:12 video 49
            $count_sections = $ids->count();
            // 16:00 video 49
            $count_student = student::whereIn('section_id', $ids)->count();
            // another way
            // 27:30 video 49
            // $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
            // $count_sections = $ids->count();
            // $count_student = DB::table('students')->whereIn('section_id', $ids)->count();
            return view('teacher.dashboard', compact('count_sections', 'count_student'));
        });

        Route::get('student',[TeacherDashboardController::class,'index'])->name('studentt.index');
        Route::get('sectionss',[TeacherDashboardController::class,'sections'])->name('sectionn.index');
        Route::post('attendancee',[TeacherDashboardController::class,'attendance'])->name('attendance');
        Route::post('editattendance', [TeacherDashboardController::class, 'edit_attendance'])->name('attendance.edit');


    }
);
