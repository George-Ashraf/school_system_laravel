<?php

namespace App\Providers;

use App\repo\AttendanceRepository;
use App\repo\AttendanceRepositoryInterface;
use App\repo\ExamRepository;
use App\repo\ExamRepositoryInterface;
use App\repo\FeeInvoiceRepository;
use App\repo\FeeInvoiceRepositoryInterface;
use App\repo\FeeRepository;
use App\repo\FeeRepositoryInterface;
use App\repo\GraduatedRepository;
use App\repo\GraduatedRepositoryInterface;
use App\repo\LibraryRepositry;
use App\repo\LibraryRepositryInterface;
use App\repo\PaymentRepository;
use App\repo\PaymentRepositoryInterface;
use App\repo\ProcessingFeeRepository;
use App\repo\ProcessingFeeRepositoryInterface;
use App\repo\PromotionRepository;
use App\repo\PromotionRepositoryInterface;
use App\repo\QuestionRepository;
use App\repo\QuestionRepositoryInterface;
use App\repo\QuizReopsitry;
use App\repo\QuizReopsitryInterface;
use App\repo\ReceiptStudentsRepository;
use App\repo\ReceiptStudentsRepositoryInterface;
use App\repo\StudentRepository;
use App\repo\StudentRepositoryInterface;
use App\repo\SubjectRepository;
use App\repo\SubjectRepositoryInterface;
use App\repo\TeacherRepository;
use App\repo\TeacherRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * 44:24 video 18
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(GraduatedRepositoryInterface::class, GraduatedRepository::class);
        $this->app->bind(FeeRepositoryInterface::class, FeeRepository::class);
        $this->app->bind(FeeInvoiceRepositoryInterface::class, FeeInvoiceRepository::class);
        $this->app->bind(ReceiptStudentsRepositoryInterface::class, ReceiptStudentsRepository::class);
        $this->app->bind(ProcessingFeeRepositoryInterface::class, ProcessingFeeRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->bind(QuizReopsitryInterface::class, QuizReopsitry::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(LibraryRepositryInterface::class,LibraryRepositry::class);




    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
