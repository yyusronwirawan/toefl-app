<?php

use Illuminate\Support\Facades\Route;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\Setting\TemplateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MasterData\CategoryController;
use App\Http\Controllers\Admin\MasterData\AnnouncementController;
use App\Http\Controllers\Admin\MasterData\FaqController;

use App\Http\Controllers\Admin\User\UserController;

use App\Http\Controllers\Admin\Lesson\ValueCategoryController;
use App\Http\Controllers\Admin\Lesson\DetailValueCategoryController;
use App\Http\Controllers\Admin\Lesson\QuestionTitleController;
use App\Http\Controllers\Admin\Lesson\QuestionController;

use App\Http\Controllers\Admin\Exam\ExamController;

use App\Http\Controllers\Admin\Transaction\BankController;
use App\Http\Controllers\Admin\Transaction\TransactionController;

use App\Http\Controllers\Admin\Region\RegionController;

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\AnnouncementController as UserAnnouncementController;
use App\Http\Controllers\User\FaqController as UserFaqController;

use App\Http\Controllers\User\TryOut\CategoryController as UserCategoryController;
use App\Http\Controllers\User\TryOut\ExamController as UserExamController;
use App\Http\Controllers\User\TryOut\GradeController as UserGradeController;

use App\Http\Controllers\User\Transaction\TransactionController as UserTransactionController;
use App\Http\Controllers\User\Transaction\VoucherActivationController as UserVoucherActivationController;

use App\Http\Controllers\User\UserController as UserUserController;

use App\Http\Controllers\TestingController;
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

Route::get('testing', [TestingController::class, 'index']);
Route::get('check-connection', [TestingController::class, 'checkConnection']);

Route::get('/', [HomeController::class,'index'])->name('home');

Route::post('upload', [DashboardController::class, 'upload'])->name('upload');

// admin site
Route::group(['middleware' => ['auth', 'admin', 'accountIsActive']], function() {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('/settings', SettingController::class)->only(['index', 'store']);

        Route::resource('/categories', CategoryController::class)->except(['show']);
        Route::get('categories/{id}/question-titles', [CategoryController::class, 'getQuestionTitle'])->name('categories.question-titles');
        Route::get('categories/{id}/value-categories', [CategoryController::class, 'getValueCategory'])->name('categories.value-categories');
        
        Route::resource('announcements', AnnouncementController::class);
        
        Route::resource('faqs', FaqController::class);

        Route::resource('value-categories', ValueCategoryController::class)->except(['show']);

        Route::resource('value-categories.detail-value-categories', DetailValueCategoryController::class)->except(['show']);

        Route::resource('question-titles', QuestionTitleController::class)->except(['show']);
        Route::get('question-titles/{id}/format-import-excel', [QuestionTitleController::class, 'importExcelFormat'])->name('question-titles.format-import-excel');

        Route::resource('question-titles.questions', QuestionController::class);
        Route::get('question-titles/{id}/delete-question', [QuestionController::class, 'deleteQuestion'])->name('question-titles.questions.delete-question');
        Route::post('question-titles/{id}/import-excel', [QuestionController::class, 'importExcel'])->name('question-titles.questions.import-excel');
        Route::get('question-titles/{id}/export-excel', [QuestionController::class, 'exportExcel'])->name('question-titles.questions.export-excel');
        Route::post('question-titles/{id}/questions/generate-question', [QuestionController::class, 'generateQuestion'])->name('question_titles.questions.generate_question');

        Route::resource('users', UserController::class);
        Route::get('users/{id}/change-user-status', [UserController::class, 'changeUserStatus']);
        Route::get('users/{user}/activation-reminder', [UserController::class, 'activationReminder'])->name('users.activation_reminder');
        Route::get('users/{user}/member-reminder', [UserController::class, 'memberReminder'])->name('users.member_reminder');

        Route::resource('exams', ExamController::class);
        Route::get('exams/{id}/change-exam-status', [ExamController::class, 'changeExamStatus']);
        Route::get('exams/grades/{id}/unblocked', [ExamController::class, 'unblocked']);
        Route::delete('exams/grades/{id}/destroy', [ExamController::class, 'deleteExam']);
        Route::get('exams/grades/{id}/regenerate-score', [ExamController::class, 'regenerateScore']);
        Route::get('exams/{id}/regenerate-block-tokens', [ExamController::class, 'regenerateBlockToken']);
        Route::get('exams/{examId}/grades/{gradeId}', [ExamController::class, 'gradeStudent']);
        Route::get('exams/{examId}/grades/{gradeId}/certificate', [ExamController::class, 'certificate']);
        Route::get('exams/{examId}/export-pdf', [ExamController::class, 'exportPdf']);

        Route::resource('banks', BankController::class)->except(['show']);

        Route::get('transactions/export', [TransactionController::class, 'export'])->name('transactions.export');
        Route::resource('transactions', TransactionController::class);
        Route::get('transactions/{transaction}/invoice', [TransactionController::class, 'invoice'])->name('transactions.invoice');

        Route::resource('templates', TemplateController::class)->except(['show']);
        Route::get('templates/{id}/generate-template', [TemplateController::class, 'generateTemplate'])->name('templates.generate-template');
        Route::post('templates/{id}/generate-template', [TemplateController::class, 'storeGenerateTemplate'])->name('templates.store-generate-template');
    });
});

// user site
Route::group(['middleware' => ['auth', 'accountIsActive']], function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
        // dashboard
        Route::get('dashboard', UserDashboardController::class)->name('user.dashboard');

        Route::resource('announcements', UserAnnouncementController::class)->only(['index', 'show']);

        Route::get('faqs', [UserFaqController::class, 'index']);

        Route::get('categories', [UserCategoryController::class, 'index']);

        Route::resource('categories.exams', UserExamController::class)->only(['index', 'show']);

        Route::get('exams/{id}/exam-start', [UserExamController::class, 'examStart'])->name('exams.exam-start');
        Route::get('exams/{id}/exam-reset', [UserExamController::class, 'examReset'])->name('exams.exam-reset');
        Route::get('exams/{exam_id}/grades/{grade_id}/sections/{section}', [UserExamController::class, 'examShowQuestion'])->name('exams.exam-show-questions');
        Route::post('exams/{id}/exam-answer', [UserExamController::class, 'answerQuestion'])->name('exams.exam-answer');
        Route::post('exams/{id}/audio-played', [UserExamController::class, 'audioPlayed'])->name('exams.audio-played');
        Route::post('exams/{id}/exam-end', [UserExamController::class, 'endExam'])->name('exams.exam-end');
        Route::post('exams/{id}/decrement-tolerance', [UserExamController::class, 'decrementTolerance'])->name('exams.decrement-tolerance');
        Route::get('exams/{exam_id}/grades/{grade_id}/unblocked', [UserExamController::class, 'unblocked']);
        
        Route::resource('grades', UserGradeController::class)->only(['index', 'show']);
        Route::get('grades/{id}/certificate', [UserGradeController::class, 'certificate']);

        Route::resource('transactions', UserTransactionController::class)->only(['index', 'show']);
        Route::get('transactions/exams/{id}/buy', [UserTransactionController::class, 'buy'])->name('transactions.buy');
        Route::resource('/voucher-activations', UserVoucherActivationController::class)->only(['index', 'store']);

        Route::resource('users', UserUserController::class)->only(['index', 'edit', 'update']);

        Route::resource('grades', UserGradeController::class)->only(['index', 'show']);
    });
});

Route::group(['namespace' => '\App\Http\Controllers\Admin\Region'], function() {
    // regional
    route::get('region/province', 'RegionController@province');
    route::get('region/city/{provinsi_id}', 'RegionController@city');
    route::get('region/district/{city_id}', 'RegionController@district');
    route::get('region/village/{district_id}', 'RegionController@village');
});

Route::get('user/{id}/activation', '\App\Http\Controllers\ActivationController@activation');
Route::get('user/{id}/activation/actived', '\App\Http\Controllers\ActivationController@actived');
Route::get('user/forgot-password', '\App\Http\Controllers\ActivationController@forgotPassword');
Route::post('user/forgot-password', '\App\Http\Controllers\ActivationController@storeForgotPassword');
