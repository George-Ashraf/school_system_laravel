<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeeInvoiceController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\GraduatedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProcessingfeeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReceiptStudentsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\ZoomController;
use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;

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



// 15:55 video 3
// Route::group(['middleware' => ['guest']], function () {
//     Route::get('/', function () {
//         return view('auth.login');
//     });
// });
// 27:54 video 45
// Auth::routes();
// 31:49 video 45
Route::get('/', [HomeController::class, 'index'])->name('selection');
Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');

    Route::post('/login',[LoginController::class,'login'])->name('login');
    Route::get('/logout/{type}',[LoginController::class,'logout'])->name('logout');



    });

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {

        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        // grades
        Route::get('/grades', [GradesController::class, 'index'])->name('grades.index');
        Route::post('/storegrade', [GradesController::class, 'store'])->name('grades.store');
        Route::post('/updategrade/{id}', [GradesController::class, 'update'])->name('grades.update');
        Route::get('/destroygrade/{id}', [GradesController::class, 'destroy'])->name('grades.destroy');
        // classroom
        Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classroom.index');
        Route::post('/storeclassrooms', [ClassroomController::class, 'store'])->name('classroom.store');
        Route::post('/updateclassrooms/{id}', [ClassroomController::class, 'update'])->name('classroom.update');
        Route::get('/destroyclassrooms/{id}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
        // delete all
        Route::post('deleteAll', [ClassroomController::class, 'deleteAll'])->name('classroom.deleteAll');
        // filter
        // Route::post('filter',[ClassroomController::class,'filter'])->name('classroom.filter');

        // sections
        route::get('/sections', [SectionsController::class, "index"])->name('section.index');
        route::post('/storesections', [SectionsController::class, "store"])->name('section.store');
        route::post('/updatesections/{id}', [SectionsController::class, "update"])->name('section.update');
        route::get('/destroysection/{id}', [SectionsController::class, "destroy"])->name('section.destroy');
        route::get('/classes/{id}', [SectionsController::class, "getclasses"])->name('section.getclasses');

        // route::get('test',function(){
        //     return view('test');
        // });

        //parents
        // 31:40 video 14
        route::view('/add_parent', 'livewire.show_form')->name('livewire.add_parent');
        // teachers
        route::get('/teashers', [TeachersController::class, 'index'])->name('teacher.index');
        route::get('/createteashers', [TeachersController::class, 'create'])->name('teacher.create');
        route::post('/storeteashers', [TeachersController::class, 'store'])->name('teacher.store');
        route::get('/editteashers/{id}', [TeachersController::class, 'edit'])->name('teacher.edit');
        route::post('/updateteashers/{id}', [TeachersController::class, 'update'])->name('teacher.update');
        route::get('/destroyteashers/{id}', [TeachersController::class, 'destroy'])->name('teacher.destroy');

        // students
        route::get('/students', [StudentController::class, 'index'])->name('student.index');
        route::get('/createstudents', [StudentController::class, 'create'])->name('student.create');
        route::post('/storestudents', [StudentController::class, 'store'])->name('student.store');
        route::get('/editstudents/{id}', [StudentController::class, 'edit'])->name('student.edit');
        route::post('/updatestudents/{id}', [StudentController::class, 'update'])->name('student.update');
        route::get('/deletestudents/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
        route::get('/showstudents/{id}', [StudentController::class, 'show'])->name('student.show');
        route::post('/Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('student.Upload_attachment');
        route::get('/Download_attachment/{studentname}/{filename}', [StudentController::class, 'Download_attachment'])->name('student.Download_attachment');
        route::post('/Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('student.Delete_attachment');
        // 35:00 video 22
        Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);
        // promotion
        Route::get('promotion', [PromotionController::class, 'index'])->name('promotion.index');
        Route::get('createpromotion', [PromotionController::class, 'create'])->name('promotion.create');

        Route::post('storepromotion', [PromotionController::class, 'store'])->name('promotion.store');
        Route::post('destroypromotion', [PromotionController::class, 'destroy'])->name('promotion.destroy');
        // graduated
        Route::get('graduated', [GraduatedController::class, 'index'])->name('graduated.index');
        Route::get('creategraduated', [GraduatedController::class, 'create'])->name('graduated.create');
        Route::post('storegraduated', [GraduatedController::class, 'store'])->name('graduated.store');
        Route::post('returngraduated', [GraduatedController::class, 'update'])->name('graduated.update');
        Route::post('deletegraduated', [GraduatedController::class, 'destroy'])->name('graduated.destroy');
        // fees
        Route::get('fees', [FeesController::class, 'index'])->name('fees.index');
        Route::get('createfees', [FeesController::class, 'create'])->name('fees.create');
        Route::post('storefees', [FeesController::class, 'store'])->name('fees.store');
        Route::get('editfees/{id}', [FeesController::class, 'edit'])->name('fees.edit');
        Route::post('updatefees', [FeesController::class, 'update'])->name('fees.update');
        Route::post('destroyfees', [FeesController::class, 'destroy'])->name('fees.destroy');
        // fee invoice
        Route::get('/showfeesinvoice/{id}', [FeeInvoiceController::class, 'show'])->name('feeinvoice.show');
        Route::post('/storefeesinvoice', [FeeInvoiceController::class, 'store'])->name('feeinvoice.store');
        Route::get('/feesinvoice', [FeeInvoiceController::class, 'index'])->name('feeinvoice.index');
        Route::get('/editfeesinvoice/{id}', [FeeInvoiceController::class, 'edit'])->name('feeinvoice.edit');
        Route::post('/updatefeesinvoice', [FeeInvoiceController::class, 'update'])->name('feeinvoice.update');
        Route::get('destroyfeesinvoice/{id}', [FeeInvoiceController::class, 'destroy'])->name('feeinvoice.destroy');
        // receipt_student
        Route::get('receipt_student', [ReceiptStudentsController::class, 'index'])->name('receipt_student.index');
        Route::get('showreceipt_student/{id}', [ReceiptStudentsController::class, 'show'])->name('receipt_student.show');
        Route::post('storereceipt_student', [ReceiptStudentsController::class, 'store'])->name('receipt_student.store');
        Route::get('editreceipt_student/{id}', [ReceiptStudentsController::class, 'edit'])->name('receipt_student.edit');
        Route::post('updatereceipt_student', [ReceiptStudentsController::class, 'update'])->name('receipt_student.update');
        Route::get('destroyreceipt_student/{id}', [ReceiptStudentsController::class, 'destroy'])->name('receipt_student.destroy');
        // processing fee
        Route::get('processingfee', [ProcessingfeeController::class, 'index'])->name('processingfee.index');
        Route::post('storeprocessingfee', [ProcessingfeeController::class, 'store'])->name('processingfee.store');
        Route::get('showprocessingfee/{id}', [ProcessingfeeController::class, 'show'])->name('processingfee.show');
        Route::get('editprocessingfee/{id}', [ProcessingfeeController::class, 'edit'])->name('processingfee.edit');
        Route::post('updateprocessingfee', [ProcessingfeeController::class, 'update'])->name('processingfee.update');
        Route::get('destroyprocessingfee/{id}', [ProcessingfeeController::class, 'destroy'])->name('processingfee.destroy');
        // payment
        Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
        Route::post('storepayment', [paymentController::class, 'store'])->name('payment.store');
        Route::get('showpayment/{id}', [paymentController::class, 'show'])->name('payment.show');
        Route::get('editpayment/{id}', [paymentController::class, 'edit'])->name('payment.edit');
        Route::post('updatepayment', [paymentController::class, 'update'])->name('payment.update');
        Route::get('destroypayment/{id}', [paymentController::class, 'destroy'])->name('payment.destroy');
        // attendance
        Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('storeattendance', [attendanceController::class, 'store'])->name('attendance.store');
        Route::get('showattendance/{id}', [attendanceController::class, 'show'])->name('attendance.show');
        Route::post('updateattendance', [attendanceController::class, 'update'])->name('attendance.update');
        Route::get('destroyattendance/{id}', [attendanceController::class, 'destroy'])->name('attendance.destroy');
        // subject
        Route::get('subject', [SubjectController::class, 'index'])->name('subject.index');
        Route::get('createsubject', [SubjectController::class, 'create'])->name('subject.create');
        Route::post('storesubject', [subjectController::class, 'store'])->name('subject.store');
        Route::get('showsubject/{id}', [subjectController::class, 'show'])->name('subject.show');
        Route::get('editsubject/{id}', [subjectController::class, 'edit'])->name('subject.edit');
        Route::post('updatesubject', [subjectController::class, 'update'])->name('subject.update');
        Route::get('destroysubject/{id}', [subjectController::class, 'destroy'])->name('subject.destroy');
        // quiz
        Route::get('quiz', [QuizController::class, 'index'])->name('quiz.index');
        Route::get('createquiz', [QuizController::class, 'create'])->name('quiz.create');
        Route::post('storequiz', [QuizController::class, 'store'])->name('quiz.store');
        Route::get('editquiz/{id}', [QuizController::class, 'edit'])->name('quiz.edit');
        Route::post('updatequiz/{id}', [QuizController::class, 'update'])->name('quiz.update');
        Route::get('destroyquiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');
        // question
        Route::get('question', [QuestionController::class, 'index'])->name('question.index');
        Route::get('createquestion', [questionController::class, 'create'])->name('question.create');
        Route::post('storequestion', [questionController::class, 'store'])->name('question.store');
        Route::get('editquestion/{id}', [questionController::class, 'edit'])->name('question.edit');
        Route::post('updatequestion', [questionController::class, 'update'])->name('question.update');
        Route::get('destroyquestion/{id}', [questionController::class, 'destroy'])->name('question.destroy');
        // zoom
        Route::get('zoom', [ZoomController::class, 'index'])->name('zoom.index');
        Route::get('createzoom', [zoomController::class, 'create'])->name('zoom.create');
        Route::post('storezoom', [zoomController::class, 'store'])->name('zoom.store');
        Route::post('destroyzoom', [zoomController::class, 'destroy'])->name('zoom.destroy');
        // indirect zoom
        Route::get('createindirectzoom', [zoomController::class, 'indirectcreate'])->name('zoom.indirectcreate');
        Route::post('storeindirectzoom', [zoomController::class, 'indirectstore'])->name('zoom.indirectstore');

        // library
        Route::get('library', [LibraryController::class, 'index'])->name('library.index');
        Route::get('createlibrary', [libraryController::class, 'create'])->name('library.create');
        Route::post('storelibrary', [libraryController::class, 'store'])->name('library.store');
        Route::get('editlibrary/{id}', [libraryController::class, 'edit'])->name('library.edit');
        Route::post('updatelibrary', [libraryController::class, 'update'])->name('library.update');
        Route::post('destroylibrary', [libraryController::class, 'destroy'])->name('library.destroy');
        Route::get('downloadattachment/{file_name}', [libraryController::class, 'download'])->name('library.download');
        // setting
        Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('updatesetting', [SettingController::class, 'update'])->name('setting.update');




    }
);

// 11:23
// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {
// 	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
// 	Route::get('/', function()
// 	{
//         return view('dashboard');
// 	});


// });
