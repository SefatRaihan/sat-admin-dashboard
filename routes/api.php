<?php

use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\MainQuestionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Api\SupervisorController;
use App\Http\Controllers\Api\ExamSectionController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\RoleManagementController;
use App\Http\Controllers\Api\RoleNavItemApiController;
use App\Http\Controllers\Api\TitleSectionController;
use App\Http\Controllers\Api\FeatureCardController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\FaqItemController;
use App\Http\Controllers\Api\CatSectionController;
use App\Http\Controllers\Api\PricingSectionController;
use App\Http\Controllers\Api\FeatureSliderController;
use App\Http\Controllers\Api\FeatureSliderItemController;
use App\Http\Controllers\Api\MixedSectionController;

use App\Http\Controllers\Api\Cms\ContactUsTitleSectionController;
use App\Http\Controllers\Api\Cms\ContactUsWhySectionController;

use App\Http\Controllers\Api\Cms\AboutUsTitleSectionController;
use App\Http\Controllers\Api\Cms\AboutUsMissionStatementController;
use App\Http\Controllers\Api\Cms\AboutUsWhySectionController;
use App\Http\Controllers\Api\Cms\AboutUsWhySectionItemController;
use App\Http\Controllers\Api\Cms\AboutUsFaqController;
use App\Http\Controllers\Api\Cms\AboutUsFaqItemController;
use App\Http\Controllers\Api\Cms\AboutUsCtaSectionController;
use App\Http\Controllers\Api\Cms\AboutUsFounderStatementController;

use App\Http\Controllers\Api\Cms\ReferralTitleSectionController;
use App\Http\Controllers\Api\Cms\ReferralPricingSectionController;
use App\Http\Controllers\Api\Cms\ReferralFaqController;
use App\Http\Controllers\Api\Cms\ReferralCtaSectionController;
use App\Http\Controllers\Api\Cms\ReferralWhySectionController;
use App\Http\Controllers\Api\Cms\ReferralHowSectionController;
use App\Http\Controllers\Api\Cms\ReferralStepSectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 'middleware' => ['api', 'auth', 'web'],
Route::group(['as' => 'api.', 'middleware' => ['auth', 'web', 'check.permission']], function () {
    Route::get('get-role-navitems-with-selected/{id}', [RoleNavItemApiController::class, 'getnavitemWithSelected']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/students/{uuid}/update', [StudentController::class, 'update']);
    Route::resource('students', StudentController::class);
    Route::post('/students-delete', [StudentController::class, 'delete']);
    Route::post('/students/deactivate', [StudentController::class, 'deactivate']);
    Route::post('/students/send-notification', [StudentController::class, 'sendNotification']);
    Route::get('/students/export/{ids}', [StudentController::class, 'exportExcel']);
    Route::post('/students/update-status', [StudentController::class, 'updateStatus']);

    Route::resource('supervisors', SupervisorController::class);
    Route::post('/supervisors/{uuid}/update', [SupervisorController::class, 'update']);
    Route::post('/supervisors-delete', [SupervisorController::class, 'delete']);

    Route::post('/roles-delete', [RoleManagementController::class, 'delete']);
    Route::post('/roles/activate', [RoleManagementController::class, 'activate']);
    Route::post('/roles/deactivate', [RoleManagementController::class, 'deactivate']);
    Route::post('/roles/update-status', [RoleManagementController::class, 'updateStatus']);

    Route::post('/notifications-delete', [NotificationController::class, 'delete']);

    Route::resource('topic', TopicController::class);
    Route::get('get-topic', [TopicController::class, 'getTopic']);
    Route::get('get-exam', [CourseController::class, 'getExam']);
    Route::get('get-lesson', [CourseController::class, 'getLesson']);
    Route::get('lessons-by-id', [CourseController::class, 'getLessonByIds']);
    Route::get('get-chapter', [CourseController::class, 'getChapter']);
    Route::apiResource('course', CourseController::class);
    Route::post('course/{id}/update', [CourseController::class, 'update']);
    Route::post('courses-delete', [CourseController::class, 'courseDelete']);

    /*
    |--------------------------------------------------------------------------
    | API Routes for Questions
    |--------------------------------------------------------------------------
    */

    // 📌 Get all questions (supports filtering & pagination)
    Route::get('/questions', [MainQuestionController::class, 'index']);
    Route::post('/questions-delete', [MainQuestionController::class, 'delete']);


    // 📌 Create a new question
    Route::post('/questions', [MainQuestionController::class, 'store']);

    // 📌 Get a specific question by ID (with related exams & sections)
    Route::get('/questions/{id}', [MainQuestionController::class, 'show']);

    // 📌 Update a question
    Route::put('/questions/{id}', [MainQuestionController::class, 'update']);

    // 📌 Soft delete a question
    Route::delete('/questions/{id}', [MainQuestionController::class, 'destroy']);

    // 📌 Restore a soft-deleted question
    Route::post('/questions/{id}/restore', [MainQuestionController::class, 'restore']);

    // 📌 Toggle question status (active <-> inactive)
    Route::patch('/questions/{id}/update-status', [MainQuestionController::class, 'toggleStatus']);


    // 📌 Get related exams and sections for a question
    Route::get('/questions/{id}/relations', [MainQuestionController::class, 'getRelations']);

    /*
    |--------------------------------------------------------------------------
    | API Routes for Exams
    |--------------------------------------------------------------------------
    */

    Route::get('/exams/questions', [ExamSectionController::class, 'getQuestionsWithExamSection']);
    Route::post('/exams/exam-section-questions', [ExamSectionController::class, 'examSectionQuestion']);
    // Route::post('/exams/publish', [ExamSectionController::class, 'examPublish']);
    Route::apiResource('/exams', ExamController::class);
    Route::post('/exam-delete', [ExamController::class, 'delete']);
    Route::post('/exams/{id}/restore', [ExamController::class, 'restore']);
    Route::patch('/exams/{id}/update-status', [ExamController::class, 'toggleStatus']);

    Route::post('/registrations', [RegistrationController::class, 'store']);
    Route::get('/registrations', [RegistrationController::class, 'index']);

    Route::get('/results', [ExamController::class, 'results']);
    Route::get('/ranking', [ExamController::class, 'ranking']);
    Route::patch('/exams/{id}/ranking', [ExamController::class, 'updateRanking']);
    Route::post('/exams/{id}/move-ranking', [ExamController::class, 'moveRanking']);
    // Route::middleware('auth')->get('/student-history', [StudentController::class, 'history']);
    Route::post('/feedback', [FeedbackController::class, 'store']);

    Route::prefix('chapters')->group(function () {
        Route::get('/', [ChapterController::class, 'index']);
        Route::post('/', [ChapterController::class, 'store']);
        Route::get('/{id}', [ChapterController::class, 'show']);
        Route::patch('/{id}', [ChapterController::class, 'update']);
        Route::patch('/{id}/state', [ChapterController::class, 'updateState']);
        Route::post('/delete', [ChapterController::class, 'destroy']);
    });

    Route::get('/lessons', [LessonController::class, 'index']);
    Route::post('/lessons', [LessonController::class, 'store']);
    Route::get('/lessons/{id}', [LessonController::class, 'show']);
    Route::post('/lessons/{id}', [LessonController::class, 'update']);
    Route::post('/lessons/delete', [LessonController::class, 'destroy']);
    Route::patch('/lessons/{id}/update-status', [LessonController::class, 'updateStatus']);
    Route::post('/upload-file', [LessonController::class, 'uploadFile']);
    Route::get('/courses/mark-complete/{courseId}/{chapterId}/{lessonId}', [CourseController::class, 'markComplete']);
    Route::get('/courses/lessons/{courseId}/{chapterId}/{lessonId}', [StudentController::class, 'getCourseLessons']);
    Route::get('/courses/{courseId}/progress', [StudentController::class, 'getCourseProgress']);
    Route::get('/courses/search', [CourseController::class, 'searchCourses']);


});

Route::post('/title-section', [TitleSectionController::class, 'storeOrUpdate']);
Route::get('/title-section', [TitleSectionController::class, 'show']);


Route::get('feature-cards', [FeatureCardController::class, 'index']); // Get all feature cards
Route::get('feature-cards/{id}', [FeatureCardController::class, 'show']); // Get a single feature card
Route::post('feature-cards', [FeatureCardController::class, 'store']); // Create a feature card
Route::post('feature-cards/{id}', [FeatureCardController::class, 'update']); // Update a feature card
Route::delete('feature-cards/{id}', [FeatureCardController::class, 'destroy']); // Delete a feature card

Route::get('faqs', [FaqController::class, 'index']);
Route::post('faqs', [FaqController::class, 'store']);
Route::get('faqs/{id}', [FaqController::class, 'show']);
Route::put('faqs/{id}', [FaqController::class, 'update']);
Route::delete('faqs/{id}', [FaqController::class, 'destroy']);
Route::apiResource('faq-items', FaqItemController::class);

Route::post('/cta-section', [CatSectionController::class, 'storeOrUpdate']);
Route::get('/cta-section', function () {
    return \App\Models\CatSection::first();
});


Route::get('pricing-sections', [PricingSectionController::class, 'index']);
Route::post('pricing-sections', [PricingSectionController::class, 'store']);

Route::get('feature-sliders', [FeatureSliderController::class, 'index']);
Route::post('feature-sliders', [FeatureSliderController::class, 'store']);
Route::get('feature-sliders/{feature_slider}', [FeatureSliderController::class, 'show']);
Route::put('feature-sliders/{feature_slider}', [FeatureSliderController::class, 'update']);
Route::delete('feature-sliders/{feature_slider}', [FeatureSliderController::class, 'destroy']);

// Route::apiResource('feature-slider-items', FeatureSliderItemController::class);

Route::post('/mixed-sections', [MixedSectionController::class, 'storeOrUpdateMultipleMixedSections']);
Route::get('/mixed-sections', [MixedSectionController::class, 'getAllMixedSections']);
Route::get('/amixed-sections', [MixedSectionController::class, 'getAllMixedSections']);

Route::post('/contact-us-title-section', [ContactUsTitleSectionController::class, 'storeOrUpdate']);
Route::get('/contact-us-title-section', [ContactUsTitleSectionController::class, 'show']);

Route::post('/about-us-title-section', [AboutUsTitleSectionController::class, 'storeOrUpdate']);
Route::get('/about-us-title-section', [AboutUsTitleSectionController::class, 'show']);

Route::get('/contact-us-why-section', [ContactUsWhySectionController::class, 'show']);
Route::post('/contact-us-why-section', [ContactUsWhySectionController::class, 'storeOrUpdate']);

Route::get('/about-us-mission', [AboutUsMissionStatementController::class, 'show']);
Route::post('/about-us-mission', [AboutUsMissionStatementController::class, 'storeOrUpdate']);

Route::get('about-us-why-sections', [AboutUsWhySectionController::class, 'index']);
Route::post('about-us-why-sections', [AboutUsWhySectionController::class, 'store']);
Route::get('about-us-why-sections/{id}', [AboutUsWhySectionController::class, 'show']);
Route::put('about-us-why-sections/{id}', [AboutUsWhySectionController::class, 'update']);
Route::delete('about-us-why-sections/{id}', [AboutUsWhySectionController::class, 'destroy']);

Route::apiResource('about-us-why-section-items', AboutUsWhySectionItemController::class);

Route::get('about-us-faqs', [AboutUsFaqController::class, 'index']);
Route::post('about-us-faqs', [AboutUsFaqController::class, 'store']);
Route::get('about-us-faqs/{id}', [AboutUsFaqController::class, 'show']);
Route::put('about-us-faqs/{id}', [AboutUsFaqController::class, 'update']);
Route::delete('about-us-faqs/{id}', [AboutUsFaqController::class, 'destroy']);
Route::apiResource('about-us-faq-items', AboutUsFaqItemController::class);

Route::post('/about-us-cta-section', [AboutUsCtaSectionController::class, 'storeOrUpdate']);
Route::get('/about-us-cta-section', function () {
    return \App\Models\AboutUsCtaSection::first();
});

Route::get('/about-us-founder-statement', [AboutUsFounderStatementController::class, 'index']);
Route::post('/about-us-founder-statement', [AboutUsFounderStatementController::class, 'storeOrUpdate']);



Route::post('/referral-title-section', [ReferralTitleSectionController::class, 'storeOrUpdate']);
Route::get('/referral-title-section', [ReferralTitleSectionController::class, 'show']);

Route::get('referral-pricing-sections', [ReferralPricingSectionController::class, 'index']);
Route::post('referral-pricing-sections', [ReferralPricingSectionController::class, 'store']);

Route::get('referral-faqs', [ReferralFaqController::class, 'index']);
Route::post('referral-faqs', [ReferralFaqController::class, 'store']);
Route::get('referral-faqs/{id}', [ReferralFaqController::class, 'show']);
Route::put('referral-faqs/{id}', [ReferralFaqController::class, 'update']);
Route::delete('referral-faqs/{id}', [ReferralFaqController::class, 'destroy']);

Route::post('/referral-cta-section', [ReferralCtaSectionController::class, 'storeOrUpdate']);
Route::get('/referral-cta-section', function () {
    return \App\Models\ReferralCtaSection::first();
});

Route::get('referral-why-sections', [ReferralWhySectionController::class, 'index']);
Route::post('referral-why-sections', [ReferralWhySectionController::class, 'store']);
Route::get('referral-why-sections/{id}', [ReferralWhySectionController::class, 'show']);
Route::put('referral-why-sections/{id}', [ReferralWhySectionController::class, 'update']);
Route::delete('referral-why-sections/{id}', [ReferralWhySectionController::class, 'destroy']);

// Route::apiResource('referral-why-section-items', ReferralWhySectionItemController::class);


// Referral How Sections
Route::get('referral-how-sections', [ReferralHowSectionController::class, 'index']);
Route::post('referral-how-sections', [ReferralHowSectionController::class, 'store']);
Route::get('referral-how-sections/{id}', [ReferralHowSectionController::class, 'show']);
Route::put('referral-how-sections/{id}', [ReferralHowSectionController::class, 'update']);
Route::delete('referral-how-sections/{id}', [ReferralHowSectionController::class, 'destroy']);

// Route::apiResource('referral-how-section-items', ReferralHowSectionItemController::class);


// Referral Step Sections
Route::get('referral-step-sections', [ReferralStepSectionController::class, 'index']);
Route::post('referral-step-sections', [ReferralStepSectionController::class, 'store']);
Route::get('referral-step-sections/{id}', [ReferralStepSectionController::class, 'show']);
Route::put('referral-step-sections/{id}', [ReferralStepSectionController::class, 'update']);
Route::delete('referral-step-sections/{id}', [ReferralStepSectionController::class, 'destroy']);

// Route::apiResource('referral-step-section-items', ReferralStepSectionItemController::class);
