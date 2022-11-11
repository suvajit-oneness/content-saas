<?php

use App\Http\Controllers\Admin\EventPageController;
use App\Http\Controllers\Admin\PlansPriceCategoryController;
use App\Http\Controllers\Admin\PlansPriceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
    //admin password reset routes
    Route::post('/password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Admin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::get('/register', 'Admin\RegisterController@showRegistrationForm')->name('admin.register')->middleware('hasInvitation');
    Route::post('/register', 'Admin\RegisterController@register')->name('admin.register.post');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/dashboard', 'Admin\ProfileController@dashboard')->name('admin.dashboard');
        Route::get('/invite_list', 'Admin\InvitationController@index')->name('admin.invite');
        Route::get('/invitation', 'Admin\InvitationController@create')->name('admin.invite.create');
        Route::post('/invitation', 'Admin\InvitationController@store')->name('admin.invitation.store');
        Route::get('/adminuser', 'Admin\AdminUserController@index')->name('admin.adminuser');
        Route::post('/adminuser', 'Admin\AdminUserController@updateAdminUser')->name('admin.adminuser.update');
        Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');
        Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile');
        Route::post('/profile', 'Admin\ProfileController@update')->name('admin.profile.update');
        Route::post('/changepassword', 'Admin\ProfileController@changePassword')->name('admin.profile.changepassword');

        /** user management **/
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'Admin\UserManagementController@index')->name('admin.users.index');
            Route::post('/', 'Admin\UserManagementController@updateUser')->name('admin.users.post');
            Route::get('/{id}/delete', 'Admin\UserManagementController@delete')->name('admin.users.delete');
            Route::get('/{id}/view', 'Admin\UserManagementController@viewDetail')->name('admin.users.detail');
            Route::post('updateStatus', 'Admin\UserManagementController@updateStatus')->name('admin.users.updateStatus');
            Route::get('/{id}/details', 'Admin\UserManagementController@details')->name('admin.users.details');
        });
        
        //**  article management  **/
        Route::group(['prefix'  =>   'blog/management'], function () {
            Route::get('/', 'Admin\BlogController@index')->name('admin.article.index');
            Route::get('/create', 'Admin\BlogController@create')->name('admin.article.create');
            Route::post('/store', 'Admin\BlogController@store')->name('admin.article.store');
            Route::get('/{id}/edit', 'Admin\BlogController@edit')->name('admin.article.edit');
            Route::post('/update', 'Admin\BlogController@update')->name('admin.article.update');
            Route::get('/{id}/delete', 'Admin\BlogController@delete')->name('admin.article.delete');
            Route::post('updateStatus', 'Admin\BlogController@updateStatus')->name('admin.article.updateStatus');
            Route::post('article/updateStatus', 'Admin\BlogController@blogupdateStatus')->name('admin.articleStatus.updateStatus');
            Route::get('/{id}/details', 'Admin\BlogController@details')->name('admin.article.details');
            Route::post('/csv-store', 'Admin\BlogController@csvStore')->name('admin.article.data.csv.store');
            Route::get('/export', 'Admin\BlogController@export')->name('admin.article.data.csv.export');
        });

        //** Category management **/
        Route::group(['prefix' => 'blog/category'], function () {
            Route::get('/', 'Admin\ArticleCategoryManagementController@index')->name('admin.article-category.index');
            Route::get('/create', 'Admin\ArticleCategoryManagementController@create')->name('admin.article-category.create');
            Route::post('/store', 'Admin\ArticleCategoryManagementController@store')->name('admin.article-category.store');
            Route::get('/{id}/edit', 'Admin\ArticleCategoryManagementController@edit')->name('admin.article-category.edit');
            Route::post('/update', 'Admin\ArticleCategoryManagementController@update')->name('admin.article-category.update');
            Route::get('/{id}/delete', 'Admin\ArticleCategoryManagementController@delete')->name('admin.article-category.delete');
            Route::post('updateStatus', 'Admin\ArticleCategoryManagementController@updateStatus')->name('admin.article-category.updateStatus');
            Route::get('/{id}/details', 'Admin\ArticleCategoryManagementController@details')->name('admin.article-category.details');
            Route::post('/csv-store', 'Admin\ArticleCategoryManagementController@csvStore')->name('admin.article-category.data.csv.store');
            Route::get('/export', 'Admin\ArticleCategoryManagementController@export')->name('admin.article-category.data.csv.export');
        });

        //** Sub category management **/
        Route::group(['prefix' => 'blog/subcategory'], function () {
            Route::get('/', 'Admin\ArticleSubCategoryManagementController@index')->name('admin.article-subcategory.index');
            Route::get('/create', 'Admin\ArticleSubCategoryManagementController@create')->name('admin.article-subcategory.create');
            Route::post('/store', 'Admin\ArticleSubCategoryManagementController@store')->name('admin.article-subcategory.store');
            Route::get('/{id}/edit', 'Admin\ArticleSubCategoryManagementController@edit')->name('admin.article-subcategory.edit');
            Route::post('/update', 'Admin\ArticleSubCategoryManagementController@update')->name('admin.article-subcategory.update');
            Route::get('/{id}/delete', 'Admin\ArticleSubCategoryManagementController@delete')->name('admin.article-subcategory.delete');
            Route::post('updateStatus', 'Admin\ArticleSubCategoryManagementController@updateStatus')->name('admin.article-subcategory.updateStatus');
            Route::get('/{id}/details', 'Admin\ArticleSubCategoryManagementController@details')->name('admin.article-subcategory.details');
            Route::post('/csv-store', 'Admin\ArticleSubCategoryManagementController@csvStore')->name('admin.article-subcategory.data.csv.store');
            Route::get('/export', 'Admin\ArticleSubCategoryManagementController@export')->name('admin.article-subcategory.data.csv.export');
        });

        //** article  Tertiary Category management  **/
        Route::group(['prefix' => 'tertiary'], function () {
            Route::get('/', 'Admin\ArticleTertiaryCategoryController@index')->name('admin.article-tertiary.index');
            Route::get('/create', 'Admin\ArticleTertiaryCategoryController@create')->name('admin.article-tertiary.create');
            Route::post('/store', 'Admin\ArticleTertiaryCategoryController@store')->name('admin.article-tertiary.store');
            Route::get('/{id}/edit', 'Admin\ArticleTertiaryCategoryController@edit')->name('admin.article-tertiary.edit');
            Route::post('/update', 'Admin\ArticleTertiaryCategoryController@update')->name('admin.article-tertiary.update');
            Route::get('/{id}/delete', 'Admin\ArticleTertiaryCategoryController@delete')->name('admin.article-tertiary.delete');
            Route::post('updateStatus', 'Admin\ArticleTertiaryCategoryController@updateStatus')->name('admin.article-tertiary.updateStatus');
            Route::get('/{id}/details', 'Admin\ArticleTertiaryCategoryController@details')->name('admin.article-tertiary.details');
            Route::post('/csv-store', 'Admin\ArticleTertiaryCategoryController@csvStore')->name('admin.article-tertiary.data.csv.store');
            Route::get('/export', 'Admin\ArticleTertiaryCategoryController@export')->name('admin.article-tertiary.data.csv.export');
        });

        //** Blog/Article frontend page master  **/
        Route::group(['prefix' => 'blog/page'], function () {
            Route::get('/', 'Admin\BlogPageController@index')->name('admin.article.page.index');
            Route::get('/create', 'Admin\BlogPageController@create')->name('admin.article.page.create');
            Route::post('/store', 'Admin\BlogPageController@store')->name('admin.article.page.store');
            Route::get('/{id}/edit', 'Admin\BlogPageController@edit')->name('admin.article.page.edit');
            Route::post('/update', 'Admin\BlogPageController@update')->name('admin.article.page.update');
            Route::get('/{id}/details', 'Admin\BlogPageController@details')->name('admin.article.page.details');
        });


        //**  event type  **//
        Route::group(['prefix' => 'event/category'], function () {
            Route::get('/', 'Admin\EventTypeController@index')->name('admin.event-category.index');
            Route::get('/create', 'Admin\EventTypeController@create')->name('admin.event-category.create');
            Route::post('/store', 'Admin\EventTypeController@store')->name('admin.event-category.store');
            Route::get('/{id}/edit', 'Admin\EventTypeController@edit')->name('admin.event-category.edit');
            Route::post('/update', 'Admin\EventTypeController@update')->name('admin.event-category.update');
            Route::get('/{id}/delete', 'Admin\EventTypeController@delete')->name('admin.event-category.delete');
            Route::post('updateStatus', 'Admin\EventTypeController@updateStatus')->name('admin.event-category.updateStatus');
            Route::get('/{id}/details', 'Admin\EventTypeController@details')->name('admin.event-category.details');
            Route::post('/csv-store', 'Admin\EventTypeController@csvStore')->name('admin.event-category.data.csv.store');
            Route::get('/export', 'Admin\EventTypeController@export')->name('admin.event-category.data.csv.export');
        });

        //**  event management  **//
        Route::group(['prefix'  =>   'event'], function () {
            Route::get('/', 'Admin\EventController@index')->name('admin.event.index');
            Route::get('/create', 'Admin\EventController@create')->name('admin.event.create');
            Route::post('/store', 'Admin\EventController@store')->name('admin.event.store');
            Route::get('/{id}/edit', 'Admin\EventController@edit')->name('admin.event.edit');
            Route::post('/update', 'Admin\EventController@update')->name('admin.event.update');
            Route::get('/{id}/delete', 'Admin\EventController@delete')->name('admin.event.delete');
            Route::post('updateStatus', 'Admin\EventController@updateStatus')->name('admin.event.updateStatus');
            Route::get('/{id}/details', 'Admin\EventController@details')->name('admin.event.details');
            Route::post('/csv-store', 'Admin\EventController@csvStore')->name('admin.event.data.csv.store');
            Route::get('/export', 'Admin\EventController@export')->name('admin.event.data.csv.export');
        });
        
        //** Deals frontend page master  **/
        Route::group(['prefix' => 'events/page'], function () {
            Route::get('/', 'Admin\EventPageController@index')->name('admin.events.page.index');
            Route::get('/create', 'Admin\EventPageController@create')->name('admin.events.page.create');
            Route::post('/store', 'Admin\EventPageController@store')->name('admin.events.page.store');
            Route::get('/{id}/edit', 'Admin\EventPageController@edit')->name('admin.events.page.edit');
            Route::post('/update', 'Admin\EventPageController@update')->name('admin.events.page.update');
            Route::get('/{id}/details', 'Admin\EventPageController@details')->name('admin.events.page.details');
        });

        // ** Order Management routes */
        Route::group(['prefix'  =>   'orders'], function () {
            Route::get('/', 'Admin\OrderController@index')->name('admin.order.index');
            // Route::get('/create', 'Admin\OrderController@create')->name('admin.order.create');
            // Route::post('/store', 'Admin\OrderController@store')->name('admin.order.store');
            // Route::get('/{id}/edit', 'Admin\OrderController@edit')->name('admin.order.edit');
            // Route::post('/update', 'Admin\OrderController@update')->name('admin.order.update');
            // Route::get('/{id}/delete', 'Admin\OrderController@delete')->name('admin.order.delete');
            Route::post('updateStatus', 'Admin\OrderController@updateStatus')->name('admin.order.updateStatus');
            Route::get('/{id}/details', 'Admin\OrderController@details')->name('admin.order.details');
            // Route::post('/csv-store', 'Admin\OrderController@csvStore')->name('admin.order.data.csv.store');
            // Route::get('/export', 'Admin\OrderController@export')->name('admin.order.data.csv.export');
        });

        //** course category management   **/
        Route::group(['prefix' => 'course/category'], function () {
            Route::get('/', 'Admin\CourseCategoryController@index')->name('admin.course-category.index');
            Route::get('/create', 'Admin\CourseCategoryController@create')->name('admin.course-category.create');
            Route::post('/store', 'Admin\CourseCategoryController@store')->name('admin.course-category.store');
            Route::get('/{id}/edit', 'Admin\CourseCategoryController@edit')->name('admin.course-category.edit');
            Route::post('/update', 'Admin\CourseCategoryController@update')->name('admin.course-category.update');
            Route::get('/{id}/delete', 'Admin\CourseCategoryController@delete')->name('admin.course-category.delete');
            Route::post('updateStatus', 'Admin\CourseCategoryController@updateStatus')->name('admin.course-category.updateStatus');
            Route::get('/{id}/details', 'Admin\CourseCategoryController@details')->name('admin.course-category.details');
            Route::post('/csv-store', 'Admin\CourseCategoryController@csvStore')->name('admin.course-category.data.csv.store');
            Route::get('/export', 'Admin\CourseCategoryController@export')->name('admin.course-category.data.csv.export');
        });

        // Admin/deals
        Route::group(['prefix' => 'deals'], function(){
            Route::get('/', 'Admin\DealsController@index')->name('admin.deals.index');
            Route::get('/create', 'Admin\DealsController@create')->name('admin.deals.create');
            Route::post('/store', 'Admin\DealsController@store')->name('admin.deals.store');
            Route::get('/{id}/edit', 'Admin\DealsController@edit')->name('admin.deals.edit');
            Route::post('/update', 'Admin\DealsController@update')->name('admin.deals.update');
            Route::get('/{id}/delete', 'Admin\DealsController@delete')->name('admin.deals.delete');
            Route::post('updateStatus', 'Admin\DealsController@updateStatus')->name('admin.deals.updateStatus');
            Route::get('/{id}/details', 'Admin\DealsController@details')->name('admin.deals.details');
            Route::post('/csv-store', 'Admin\DealsController@csvStore')->name('admin.deals.data.csv.store');
            Route::get('/export', 'Admin\DealsController@export')->name('admin.deals.data.csv.export');
        });

        // Admin/deals/category
        Route::group(['prefix' => 'deals/category'], function(){
            Route::get('/', 'Admin\DealsCategoryController@index')->name('admin.deals.category.index');
            Route::get('/create', 'Admin\DealsCategoryController@create')->name('admin.deals.category.create');
            Route::post('/store', 'Admin\DealsCategoryController@store')->name('admin.deals.category.store');
            Route::get('/{id}/edit', 'Admin\DealsCategoryController@edit')->name('admin.deals.category.edit');
            Route::post('/update', 'Admin\DealsCategoryController@update')->name('admin.deals.category.update');
            Route::get('/{id}/delete', 'Admin\DealsCategoryController@delete')->name('admin.deals.category.delete');
            Route::post('updateStatus', 'Admin\DealsCategoryController@updateStatus')->name('admin.deals.category.updateStatus');
            Route::get('/{id}/details', 'Admin\DealsCategoryController@details')->name('admin.deals.category.details');
        });

        //** Deals frontend page master  **/
        Route::group(['prefix' => 'deals/page'], function () {
            Route::get('/', 'Admin\DealPageController@index')->name('admin.deals.page.index');
            Route::get('/create', 'Admin\DealPageController@create')->name('admin.deals.page.create');
            Route::post('/store', 'Admin\DealPageController@store')->name('admin.deals.page.store');
            Route::get('/{id}/edit', 'Admin\DealPageController@edit')->name('admin.deals.page.edit');
            Route::post('/update', 'Admin\DealPageController@update')->name('admin.deals.page.update');
            Route::get('/{id}/details', 'Admin\DealPageController@details')->name('admin.deals.page.details');
        });

        //** course management **/
        Route::group(['prefix' => 'course'], function () {
            Route::get('/', 'Admin\CourseController@index')->name('admin.course.index');
            Route::get('/create', 'Admin\CourseController@create')->name('admin.course.create');
            Route::post('/store', 'Admin\CourseController@store')->name('admin.course.store');
            Route::get('/{id}/edit', 'Admin\CourseController@edit')->name('admin.course.edit');
            Route::post('/update', 'Admin\CourseController@update')->name('admin.course.update');

            Route::post('/update/{id}/lesson/', 'Admin\CourseController@updateCourseLesson')->name('admin.course.updateCourseLesson');
            Route::get('/{cid}/delete/lesson/{lid}', 'Admin\CourseController@deleteCourseLesson')->name('admin.course.deleteCourseLesson');

            Route::get('/{id}/delete', 'Admin\CourseController@delete')->name('admin.course.delete');
            Route::post('updateStatus', 'Admin\CourseController@updateStatus')->name('admin.course.updateStatus');
            Route::get('/{id}/details', 'Admin\CourseController@details')->name('admin.course.details');
            Route::post('/csv-store', 'Admin\CourseController@csvStore')->name('admin.course.data.csv.store');
            Route::get('/export', 'Admin\CourseController@export')->name('admin.course.data.csv.export');
        });

        //** course lesson management **/
        Route::group(['prefix' => 'course/lesson'], function () {
            Route::get('/', 'Admin\LessonController@index')->name('admin.lesson.index');
            Route::get('/create', 'Admin\LessonController@create')->name('admin.lesson.create');
            Route::post('/store', 'Admin\LessonController@store')->name('admin.lesson.store');
            Route::get('/{id}/edit', 'Admin\LessonController@edit')->name('admin.lesson.edit');
            Route::post('/update', 'Admin\LessonController@update')->name('admin.lesson.update');

            Route::post('/update/{id}/topic/', 'Admin\LessonController@updateLessonTopic')->name('admin.lesson.updateLessonTopic');
            Route::get('/delete/lesson/{lid}/topic/{tid}', 'Admin\LessonController@deleteLessonTopic')->name('admin.lesson.deleteLessonTopic');

            Route::get('/{id}/delete', 'Admin\LessonController@delete')->name('admin.lesson.delete');
            Route::post('updateStatus', 'Admin\LessonController@updateStatus')->name('admin.lesson.updateStatus');
            Route::get('/{id}/details', 'Admin\LessonController@details')->name('admin.lesson.details');
            Route::post('/csv-store', 'Admin\LessonController@csvStore')->name('admin.lesson.data.csv.store');
            Route::get('/export', 'Admin\LessonController@export')->name('admin.lesson.data.csv.export');
        });

        //** course topic management **/
        Route::group(['prefix' => 'course/topic'], function () {
            Route::get('/', 'Admin\TopicController@index')->name('admin.topic.index');
            Route::get('/create', 'Admin\TopicController@create')->name('admin.topic.create');
            Route::post('/store', 'Admin\TopicController@store')->name('admin.topic.store');
            Route::get('/{id}/edit', 'Admin\TopicController@edit')->name('admin.topic.edit');
            Route::post('/update', 'Admin\TopicController@update')->name('admin.topic.update');
            Route::get('/{id}/delete', 'Admin\TopicController@delete')->name('admin.topic.delete');
            Route::post('updateStatus', 'Admin\TopicController@updateStatus')->name('admin.topic.updateStatus');
            Route::get('/{id}/details', 'Admin\TopicController@details')->name('admin.topic.details');
            Route::post('/csv-store', 'Admin\TopicController@csvStore')->name('admin.topic.data.csv.store');
            Route::get('/export', 'Admin\TopicController@export')->name('admin.topic.data.csv.export');
        });

        //** course quiz management **/
        Route::group(['prefix' => 'course/quiz'], function () {
            Route::get('/', 'Admin\QuizController@index')->name('admin.quiz.index');
            Route::get('/create', 'Admin\QuizController@create')->name('admin.quiz.create');
            Route::post('/store', 'Admin\QuizController@store')->name('admin.quiz.store');
            Route::get('/{id}/edit', 'Admin\QuizController@edit')->name('admin.quiz.edit');
            Route::post('/update', 'Admin\QuizController@update')->name('admin.quiz.update');
            Route::get('/{id}/delete', 'Admin\QuizController@delete')->name('admin.quiz.delete');
            Route::post('updateStatus', 'Admin\QuizController@updateStatus')->name('admin.quiz.updateStatus');
            Route::get('/{id}/details', 'Admin\QuizController@details')->name('admin.quiz.details');
            Route::post('/csv-store', 'Admin\QuizController@csvStore')->name('admin.quiz.data.csv.store');
            Route::get('/export', 'Admin\QuizController@export')->name('admin.quiz.data.csv.export');
        });

        //**  course module management  **/
        Route::group(['prefix'  =>   'module'], function () {
            Route::get('/{id}', 'Admin\CourseModuleController@index')->name('admin.course.module.index');
            Route::get('/create', 'Admin\CourseModuleController@create')->name('admin.course.module.create');
            Route::post('/store', 'Admin\CourseModuleController@store')->name('admin.course.module.store');
            Route::get('/{id}/edit', 'Admin\CourseModuleController@edit')->name('admin.course.module.edit');
            Route::post('/update', 'Admin\CourseModuleController@update')->name('admin.course.module.update');
            Route::get('/{id}/delete', 'Admin\CourseModuleController@delete')->name('admin.course.module.delete');
            Route::post('updateStatus', 'Admin\CourseModuleController@updateStatus')->name('admin.course.module.updateStatus');
            Route::get('/{id}/details', 'Admin\CourseModuleController@details')->name('admin.course.module.details');
            Route::post('/csv-store', 'Admin\CourseModuleController@csvStore')->name('admin.course.module.data.csv.store');
            Route::get('/export', 'Admin\CourseModuleController@export')->name('admin.course.module.data.csv.export');
        });

        //**  course topics management  **//
        Route::group(['prefix'  =>   'topic'], function () {
            Route::get('/{id}', 'Admin\CourseTopicController@index')->name('admin.course.topic.index');
            Route::get('/create', 'Admin\CourseTopicController@create')->name('admin.course.topic.create');
            Route::post('/store', 'Admin\CourseTopicController@store')->name('admin.course.topic.store');
            Route::get('/{id}/edit', 'Admin\CourseTopicController@edit')->name('admin.course.topic.edit');
            Route::post('/update', 'Admin\CourseTopicController@update')->name('admin.course.topic.update');
            Route::get('/{id}/delete', 'Admin\CourseTopicController@delete')->name('admin.course.topic.delete');
            Route::post('updateStatus', 'Admin\CourseTopicController@updateStatus')->name('admin.course.topic.updateStatus');
            Route::get('/{id}/details', 'Admin\CourseTopicController@details')->name('admin.course.topic.details');
            Route::post('/csv-store', 'Admin\CourseTopicController@csvStore')->name('admin.course.topic.data.csv.store');
            Route::get('/export', 'Admin\CourseTopicController@export')->name('admin.course.topic.data.csv.export');
        });

        //**  course slide management  **//
        Route::group(['prefix'  =>   'slide'], function () {
            Route::get('/{id}', 'Admin\CourseSlideController@index')->name('admin.course.slide.index');
            Route::get('/create', 'Admin\CourseSlideController@create')->name('admin.course.slide.create');
            Route::post('/store', 'Admin\CourseSlideController@store')->name('admin.course.slide.store');
            Route::get('/{id}/edit', 'Admin\CourseSlideController@edit')->name('admin.course.slide.edit');
            Route::post('/update', 'Admin\CourseSlideController@update')->name('admin.course.slide.update');
            Route::get('/{id}/delete', 'Admin\CourseSlideController@delete')->name('admin.course.slide.delete');
            Route::post('updateStatus', 'Admin\CourseSlideController@updateStatus')->name('admin.course.slide.updateStatus');
            Route::get('/{id}/details', 'Admin\CourseSlideController@details')->name('admin.course.slide.details');
            Route::post('/csv-store', 'Admin\CourseSlideController@csvStore')->name('admin.course.slide.data.csv.store');
            Route::get('/export', 'Admin\CourseSlideController@export')->name('admin.course.slide.data.csv.export');
        });

        //**  course quiz management  **//
        Route::group(['prefix'  =>   'quiz'], function () {
            Route::get('/{id}', 'Admin\CourseQuizController@index')->name('admin.course.quiz.index');
            Route::get('/create', 'Admin\CourseQuizController@create')->name('admin.course.quiz.create');
            Route::post('/store', 'Admin\CourseQuizController@store')->name('admin.course.quiz.store');
            Route::get('/{id}/edit', 'Admin\CourseQuizController@edit')->name('admin.course.quiz.edit');
            Route::post('/update', 'Admin\CourseQuizController@update')->name('admin.course.quiz.update');
            Route::get('/{id}/delete', 'Admin\CourseQuizController@delete')->name('admin.course.quiz.delete');
            Route::post('updateStatus', 'Admin\CourseQuizController@updateStatus')->name('admin.course.quiz.updateStatus');
            Route::get('/{id}/details', 'Admin\CourseQuizController@details')->name('admin.course.quiz.details');
            Route::post('/csv-store', 'Admin\CourseQuizController@csvStore')->name('admin.course.quiz.data.csv.store');
            Route::get('/export', 'Admin\CourseQuizController@export')->name('admin.course.quiz.data.csv.export');
        });

        //**  course testimonial management  **//
        Route::group(['prefix'  =>   'testimonial'], function () {
            Route::get('/{id}', 'Admin\CourseTestimonialController@index')->name('admin.course.testimonial.index');
            Route::get('/create', 'Admin\CourseTestimonialController@create')->name('admin.course.testimonial.create');
            Route::post('/store', 'Admin\CourseTestimonialController@store')->name('admin.course.testimonial.store');
            Route::get('/{id}/edit', 'Admin\CourseTestimonialController@edit')->name('admin.course.testimonial.edit');
            Route::post('/update', 'Admin\CourseTestimonialController@update')->name('admin.course.testimonial.update');
            Route::get('/{id}/delete', 'Admin\CourseTestimonialController@delete')->name('admin.course.testimonial.delete');
            Route::post('updateStatus', 'Admin\CourseTestimonialController@updateStatus')->name('admin.course.testimonial.updateStatus');
            Route::get('/{id}/details', 'Admin\CourseTestimonialController@details')->name('admin.course.testimonial.details');
            Route::post('/csv-store', 'Admin\CourseTestimonialController@csvStore')->name('admin.course.testimonial.data.csv.store');
            Route::get('/export', 'Admin\CourseTestimonialController@export')->name('admin.course.testimonial.data.csv.export');
        });
        // });

        //**  market management  **/
        Route::group(['prefix'  =>   'market'], function () {
            Route::get('/', 'Admin\MarketController@index')->name('admin.market.index');
            Route::get('/create', 'Admin\MarketController@create')->name('admin.market.create');
            Route::post('/store', 'Admin\MarketController@store')->name('admin.market.store');
            Route::get('/{id}/edit', 'Admin\MarketController@edit')->name('admin.market.edit');
            Route::post('/update', 'Admin\MarketController@update')->name('admin.market.update');
            Route::get('/{id}/delete', 'Admin\MarketController@delete')->name('admin.market.delete');
            Route::post('updateStatus', 'Admin\MarketController@updateStatus')->name('admin.market.updateStatus');
            Route::get('/{id}/details', 'Admin\MarketController@details')->name('admin.market.details');
            Route::post('/csv-store', 'Admin\MarketController@csvStore')->name('admin.market.data.csv.store');
            Route::get('/export', 'Admin\MarketController@export')->name('admin.market.data.csv.export');
        });

        //**  market category management  **/
        Route::group(['prefix'  =>   'market/category'], function () {
            Route::get('/', 'Admin\MarketCategoryController@index')->name('admin.market.category.index');
            Route::get('/create', 'Admin\MarketCategoryController@create')->name('admin.market.category.create');
            Route::post('/store', 'Admin\MarketCategoryController@store')->name('admin.market.category.store');
            Route::get('/{id}/edit', 'Admin\MarketCategoryController@edit')->name('admin.market.category.edit');
            Route::post('/update', 'Admin\MarketCategoryController@update')->name('admin.market.category.update');
            Route::get('/{id}/delete', 'Admin\MarketCategoryController@delete')->name('admin.market.category.delete');
            Route::post('updateStatus', 'Admin\MarketCategoryController@updateStatus')->name('admin.market.category.updateStatus');
            Route::get('/{id}/details', 'Admin\MarketCategoryController@details')->name('admin.market.category.details');
            Route::post('/csv-store', 'Admin\MarketCategoryController@csvStore')->name('admin.market.category.data.csv.store');
            Route::get('/export', 'Admin\MarketCategoryController@export')->name('admin.market.category.data.csv.export');
        });

        //**  market banner management  **//
        Route::group(['prefix'  =>   'market/banner'], function () {
            Route::get('/', 'Admin\MarketBannerController@index')->name('admin.market.banner.index');
            Route::get('/create', 'Admin\MarketBannerController@create')->name('admin.market.banner.create');
            Route::post('/store', 'Admin\MarketBannerController@store')->name('admin.market.banner.store');
            Route::get('/{id}/edit', 'Admin\MarketBannerController@edit')->name('admin.market.banner.edit');
            Route::post('/update', 'Admin\MarketBannerController@update')->name('admin.market.banner.update');
            Route::get('/{id}/delete', 'Admin\MarketBannerController@delete')->name('admin.market.banner.delete');
            Route::post('updateStatus', 'Admin\MarketBannerController@updateStatus')->name('admin.market.banner.updateStatus');
            Route::get('/{id}/details', 'Admin\MarketBannerController@details')->name('admin.market.banner.details');
            Route::post('/csv-store', 'Admin\MarketBannerController@csvStore')->name('admin.market.banner.data.csv.store');
            Route::get('/export', 'Admin\MarketBannerController@export')->name('admin.market.banner.data.csv.export');
        });

        //**  market faq management  **//
        Route::group(['prefix'  =>   'market/faq'], function () {
            Route::get('/', 'Admin\MarketFaqController@index')->name('admin.market.faq.index');
            Route::get('/create', 'Admin\MarketFaqController@create')->name('admin.market.faq.create');
            Route::post('/store', 'Admin\MarketFaqController@store')->name('admin.market.faq.store');
            Route::get('/{id}/edit', 'Admin\MarketFaqController@edit')->name('admin.market.faq.edit');
            Route::post('/update', 'Admin\MarketFaqController@update')->name('admin.market.faq.update');
            Route::get('/{id}/delete', 'Admin\MarketFaqController@delete')->name('admin.market.faq.delete');
            Route::post('updateStatus', 'Admin\MarketFaqController@updateStatus')->name('admin.market.faq.updateStatus');
            Route::get('/{id}/details', 'Admin\MarketFaqController@details')->name('admin.market.faq.details');
            Route::post('/csv-store', 'Admin\MarketFaqController@csvStore')->name('admin.market.faq.data.csv.store');
            Route::get('/export', 'Admin\MarketFaqController@export')->name('admin.market.faq.data.csv.export');
        });

        // Marketplace- FAQ management
        Route::group(['prefix'  =>   '/marketplace/faq'], function () {
            Route::get('/', 'Admin\MarketPlaceFaqController@index')->name('admin.marketplace.faq.index');
            Route::get('/create', 'Admin\MarketPlaceFaqController@create')->name('admin.marketplace.faq.create');
            Route::post('/store', 'Admin\MarketPlaceFaqController@store')->name('admin.marketplace.faq.store');
            Route::get('/{id}/edit', 'Admin\MarketPlaceFaqController@edit')->name('admin.marketplace.faq.edit');
            Route::post('/update', 'Admin\MarketPlaceFaqController@update')->name('admin.marketplace.faq.update');
            Route::get('/{id}/delete', 'Admin\MarketPlaceFaqController@delete')->name('admin.marketplace.faq.delete');
            Route::post('updateStatus', 'Admin\MarketPlaceFaqController@updateStatus')->name('admin.marketplace.faq.updateStatus');
            Route::get('/{id}/details', 'Admin\MarketPlaceFaqController@details')->name('admin.marketplace.faq.details');
            Route::post('/csv-store', 'Admin\MarketPlaceFaqController@csvStore')->name('admin.marketplace.faq.data.csv.store');
            Route::get('/export', 'Admin\MarketPlaceFaqController@export')->name('admin.marketplace.faq.data.csv.export');
        });

        //**  support management  **//
        Route::group(['prefix'  =>   'support'], function () {
            Route::get('/', 'Admin\SupportController@index')->name('admin.support.index');
            Route::get('/create', 'Admin\SupportController@create')->name('admin.support.create');
            Route::post('/store', 'Admin\SupportController@store')->name('admin.support.store');
            Route::get('/{id}/edit', 'Admin\SupportController@edit')->name('admin.support.edit');
            Route::post('/update', 'Admin\SupportController@update')->name('admin.support.update');
            Route::get('/{id}/delete', 'Admin\SupportController@delete')->name('admin.support.delete');
            Route::post('updateStatus', 'Admin\SupportController@updateStatus')->name('admin.support.updateStatus');
            Route::get('/{id}/details', 'Admin\SupportController@details')->name('admin.support.details');
            Route::post('/csv-store', 'Admin\SupportController@csvStore')->name('admin.support.data.csv.store');
            Route::get('/export', 'Admin\SupportController@export')->name('admin.support.data.csv.export');
        });
        //**  support management  **//
        Route::group(['prefix'  =>   'support/widget'], function () {
            Route::get('/', 'Admin\SupportWidgetController@index')->name('admin.support.widget.index');
            Route::get('/create', 'Admin\SupportWidgetController@create')->name('admin.support.widget.create');
            Route::post('/store', 'Admin\SupportWidgetController@store')->name('admin.support.widget.store');
            Route::get('/{id}/edit', 'Admin\SupportWidgetController@edit')->name('admin.support.widget.edit');
            Route::post('/update', 'Admin\SupportWidgetController@update')->name('admin.support.widget.update');
            Route::get('/{id}/delete', 'Admin\SupportWidgetController@delete')->name('admin.support.widget.delete');
            Route::post('updateStatus', 'Admin\SupportWidgetController@updateStatus')->name('admin.support.widget.updateStatus');
            Route::get('/{id}/details', 'Admin\SupportWidgetController@details')->name('admin.support.widget.details');
            Route::post('/csv-store', 'Admin\SupportWidgetController@csvStore')->name('admin.support.widget.data.csv.store');
            Route::get('/export', 'Admin\SupportWidgetController@export')->name('admin.support.widget.data.csv.export');
        });
        //**  support management  **//
        Route::group(['prefix'  =>   'support/faq/category'], function () {
            Route::get('/', 'Admin\SupportFaqCategoryController@index')->name('admin.support.faq.category.index');
            Route::get('/create', 'Admin\SupportFaqCategoryController@create')->name('admin.support.faq.category.create');
            Route::post('/store', 'Admin\SupportFaqCategoryController@store')->name('admin.support.faq.category.store');
            Route::get('/{id}/edit', 'Admin\SupportFaqCategoryController@edit')->name('admin.support.faq.category.edit');
            Route::post('/update', 'Admin\SupportFaqCategoryController@update')->name('admin.support.faq.category.update');
            Route::get('/{id}/delete', 'Admin\SupportFaqCategoryController@delete')->name('admin.support.faq.category.delete');
            Route::post('updateStatus', 'Admin\SupportFaqCategoryController@updateStatus')->name('admin.support.faq.category.updateStatus');
            Route::get('/{id}/details', 'Admin\SupportFaqCategoryController@details')->name('admin.support.faq.category.details');
            Route::post('/csv-store', 'Admin\SupportFaqCategoryController@csvStore')->name('admin.support.faq.category.data.csv.store');
            Route::get('/export', 'Admin\SupportFaqCategoryController@export')->name('admin.support.faq.category.data.csv.export');
        });

        //**  support management  **//
        Route::group(['prefix'  =>   'support/faq'], function () {
            Route::get('/', 'Admin\SupportFaqController@index')->name('admin.support.faq.index');
            Route::get('/create', 'Admin\SupportFaqController@create')->name('admin.support.faq.create');
            Route::post('/store', 'Admin\SupportFaqController@store')->name('admin.support.faq.store');
            Route::get('/{id}/edit', 'Admin\SupportFaqController@edit')->name('admin.support.faq.edit');
            Route::post('/update', 'Admin\SupportFaqController@update')->name('admin.support.faq.update');
            Route::get('/{id}/delete', 'Admin\SupportFaqController@delete')->name('admin.support.faq.delete');
            Route::post('updateStatus', 'Admin\SupportFaqController@updateStatus')->name('admin.support.faq.updateStatus');
            Route::get('/{id}/details', 'Admin\SupportFaqController@details')->name('admin.support.faq.details');
            Route::post('/csv-store', 'Admin\SupportFaqController@csvStore')->name('admin.support.data.csv.store');
            Route::get('/export', 'Admin\SupportFaqController@export')->name('admin.support.data.csv.export');
        });
    });
     //**  job category  **//
     Route::group(['prefix' => 'job/category'], function () {
        Route::get('/', 'Admin\JobCategoryController@index')->name('admin.job.category.index');
        Route::get('/create', 'Admin\JobCategoryController@create')->name('admin.job.category.create');
        Route::post('/store', 'Admin\JobCategoryController@store')->name('admin.job.category.store');
        Route::get('/{id}/edit', 'Admin\JobCategoryController@edit')->name('admin.job.category.edit');
        Route::post('/update', 'Admin\JobCategoryController@update')->name('admin.job.category.update');
        Route::get('/{id}/delete', 'Admin\JobCategoryController@delete')->name('admin.job.category.delete');
        Route::post('updateStatus', 'Admin\JobCategoryController@updateStatus')->name('admin.job.category.updateStatus');
        Route::get('/{id}/details', 'Admin\JobCategoryController@details')->name('admin.job.category.details');
        Route::post('/csv-store', 'Admin\JobCategoryController@csvStore')->name('admin.job.category.data.csv.store');
        Route::get('/export', 'Admin\JobCategoryController@export')->name('admin.job.category.data.csv.export');
    });

    //**  job management  **//
    Route::group(['prefix'  =>   'job'], function () {
        Route::get('/', 'Admin\JobController@index')->name('admin.job.index');
        Route::get('/create', 'Admin\JobController@create')->name('admin.job.create');
        Route::post('/store', 'Admin\JobController@store')->name('admin.job.store');
        Route::get('/{id}/edit', 'Admin\JobController@edit')->name('admin.job.edit');
        Route::post('/update', 'Admin\JobController@update')->name('admin.job.update');
        Route::get('/{id}/delete', 'Admin\JobController@delete')->name('admin.job.delete');
        Route::post('updateStatus', 'Admin\JobController@updateStatus')->name('admin.job.updateStatus');
        Route::post('updateFeatureStatus', 'Admin\JobController@updatefeatureStatus')->name('admin.job.updateFeatureStatus');
        Route::post('updateBeginnerStatus', 'Admin\JobController@updatebeginnerStatus')->name('admin.job.updateBeginnerstatus');
        Route::get('/{id}/details', 'Admin\JobController@details')->name('admin.job.details');
        Route::post('/csv-store', 'Admin\JobController@csvStore')->name('admin.job.data.csv.store');
        Route::get('/export', 'Admin\JobController@export')->name('admin.job.data.csv.export');
        Route::get('/job/application/{id}', 'Admin\JobController@application')->name('admin.job.application');
    });
          //template management
            //** Category management **/
            Route::group(['prefix' => 'template/category'], function () {
                Route::get('/', 'Admin\TemplateCategoryController@index')->name('admin.template.category.index');
                Route::get('/create', 'Admin\TemplateCategoryController@create')->name('admin.template.category.create');
                Route::post('/store', 'Admin\TemplateCategoryController@store')->name('admin.template.category.store');
                Route::get('/{id}/edit', 'Admin\TemplateCategoryController@edit')->name('admin.template.category.edit');
                Route::post('/update', 'Admin\TemplateCategoryController@update')->name('admin.template.category.update');
                Route::get('/{id}/delete', 'Admin\TemplateCategoryController@delete')->name('admin.template.category.delete');
                Route::post('updateStatus', 'Admin\TemplateCategoryController@updateStatus')->name('admin.template.category.updateStatus');
                Route::get('/{id}/details', 'Admin\TemplateCategoryController@details')->name('admin.template.category.details');
                Route::post('/csv-store', 'Admin\TemplateCategoryController@csvStore')->name('admin.template.category.data.csv.store');
                Route::get('/export', 'Admin\TemplateCategoryController@export')->name('admin.template.category.data.csv.export');
            });

            //** Sub category management **/
            Route::group(['prefix' => 'template/subcategory'], function () {
                Route::get('/', 'Admin\TemplateSubCategoryController@index')->name('admin.template.subcategory.index');
                Route::get('/create', 'Admin\TemplateSubCategoryController@create')->name('admin.template.subcategory.create');
                Route::post('/store', 'Admin\TemplateSubCategoryController@store')->name('admin.template.subcategory.store');
                Route::get('/{id}/edit', 'Admin\TemplateSubCategoryController@edit')->name('admin.template.subcategory.edit');
                Route::post('/update', 'Admin\TemplateSubCategoryController@update')->name('admin.template.subcategory.update');
                Route::get('/{id}/delete', 'Admin\TemplateSubCategoryController@delete')->name('admin.template.subcategory.delete');
                Route::post('updateStatus', 'Admin\TemplateSubCategoryController@updateStatus')->name('admin.template.subcategory.updateStatus');
                Route::get('/{id}/details', 'Admin\TemplateSubCategoryController@details')->name('admin.template.subcategory.details');
                Route::post('/csv-store', 'Admin\TemplateSubCategoryController@csvStore')->name('admin.template.subcategory.data.csv.store');
                Route::get('/export', 'Admin\TemplateSubCategoryController@export')->name('admin.template.subcategory.data.csv.export');
            });

            //**  type management  **/
            Route::group(['prefix' => 'template/type'], function () {
                Route::get('/', 'Admin\TemplateTypeController@index')->name('admin.template.type.index');
                Route::get('/create', 'Admin\TemplateTypeController@create')->name('admin.template.type.create');
                Route::post('/store', 'Admin\TemplateTypeController@store')->name('admin.template.type.store');
                Route::get('/{id}/edit', 'Admin\TemplateTypeController@edit')->name('admin.template.type.edit');
                Route::post('/update', 'Admin\TemplateTypeController@update')->name('admin.template.type.update');
                Route::get('/{id}/delete', 'Admin\TemplateTypeController@delete')->name('admin.template.type.delete');
                Route::post('updateStatus', 'Admin\TemplateTypeController@updateStatus')->name('admin.template.type.updateStatus');
                Route::get('/{id}/details', 'Admin\TemplateTypeController@details')->name('admin.template.type.details');
                Route::post('/csv-store', 'Admin\TemplateTypeController@csvStore')->name('admin.template.type.data.csv.store');
                Route::get('/export', 'Admin\TemplateTypeController@export')->name('admin.template.type.data.csv.export');
            });

            //**  template management  **/
            Route::group(['prefix'  =>   'template'], function () {
                Route::get('/', 'Admin\TemplateController@index')->name('admin.template.index');
                Route::get('/create', 'Admin\TemplateController@create')->name('admin.template.create');
                Route::post('/store', 'Admin\TemplateController@store')->name('admin.template.store');
                Route::get('/{id}/edit', 'Admin\TemplateController@edit')->name('admin.template.edit');
                Route::post('/update', 'Admin\TemplateController@update')->name('admin.template.update');
                Route::get('/{id}/delete', 'Admin\TemplateController@delete')->name('admin.template.delete');
                Route::post('updateStatus', 'Admin\TemplateController@updateStatus')->name('admin.template.updateStatus');
                Route::get('/{id}/details', 'Admin\TemplateController@details')->name('admin.template.details');
                Route::post('/csv-store', 'Admin\TemplateController@csvStore')->name('admin.template.data.csv.store');
                Route::get('/export', 'Admin\TemplateController@export')->name('admin.template.data.csv.export');
            });

            //** Frontend management **/
            Route::group(['prefix' => 'frontend-management'], function () {
                // Home-page management
                Route::group(['prefix' => '/home-page'], function(){
                    Route::get('/', 'Admin\HomePageController@index')->name('admin.homepagemanagement.index');
                    Route::get('/{id}/edit', 'Admin\HomePageController@edit')->name('admin.homepagemanagement.edit');
                    Route::post('/update', 'Admin\HomePageController@update')->name('admin.homepagemanagement.update');
                    Route::get('/{id}/details', 'Admin\HomePageController@details')->name('admin.homepagemanagement.details');
                });
            });
            
            // -------------------Master Management--------------------
            Route::group(['prefix'=>'master/'],function(){

                // Social Media master
                Route::group(['prefix' => 'socialmedia'], function () {
                    Route::get('/', 'Admin\SocialMediaController@index')->name('admin.socialmedia.master.index');
                    Route::get('/create', 'Admin\SocialMediaController@create')->name('admin.socialmedia.master.create');
                    Route::post('/store', 'Admin\SocialMediaController@store')->name('admin.socialmedia.master.store');
                    Route::get('/{id}/edit', 'Admin\SocialMediaController@edit')->name('admin.socialmedia.master.edit');
                    Route::post('/update', 'Admin\SocialMediaController@update')->name('admin.socialmedia.master.update');
                    Route::get('/{id}/delete', 'Admin\SocialMediaController@delete')->name('admin.socialmedia.master.delete');
                    Route::post('updateStatus', 'Admin\SocialMediaController@updateStatus')->name('admin.socialmedia.master.updateStatus');
                });
                // Language Master
                Route::group(['prefix' => 'language'], function () {
                    Route::get('/', 'Admin\LanguageController@index')->name('admin.language.master.index');
                    Route::get('/create', 'Admin\LanguageController@create')->name('admin.language.master.create');
                    Route::post('/store', 'Admin\LanguageController@store')->name('admin.language.master.store');
                    Route::get('/{id}/edit', 'Admin\LanguageController@edit')->name('admin.language.master.edit');
                    Route::post('/update', 'Admin\LanguageController@update')->name('admin.language.master.update');
                    Route::get('/{id}/delete', 'Admin\LanguageController@delete')->name('admin.language.master.delete');
                    Route::post('updateStatus', 'Admin\LanguageController@updateStatus')->name('admin.language.master.updateStatus');
                });

                // Plans Pricing Category
                Route::group(['prefix' => 'currency'], function () {
                    Route::get('/', 'Admin\CurrencyController@index')->name('admin.plans.category.index');
                    Route::get('/create', 'Admin\CurrencyController@create')->name('admin.plans.category.create');
                    Route::post('/store', 'Admin\CurrencyController@store')->name('admin.plans.category.store');
                    Route::get('/{id}/edit', 'Admin\CurrencyController@edit')->name('admin.plans.category.edit');
                    Route::post('/update', 'Admin\CurrencyController@update')->name('admin.plans.category.update');
                    Route::get('/{id}/delete', 'Admin\CurrencyController@delete')->name('admin.plans.category.delete');
                });
            });
              //tools-feature management
            //** Content management **//
            Route::group(['prefix' => 'tools/content'], function () {
                Route::get('/', 'Admin\ToolsController@index')->name('admin.tools.content.index');
                Route::get('/{id}/edit', 'Admin\ToolsController@edit')->name('admin.tools.content.edit');
                Route::post('/update', 'Admin\ToolsController@update')->name('admin.tools.content.update');
                Route::get('/{id}/details', 'Admin\ToolsController@details')->name('admin.tools.content.details');
            });

            //** Area of Interest Category **//
            Route::group(['prefix' => 'tools/AreaOfInterest/category'], function () {
                Route::get('/', 'Admin\ToolsInterestCategoryController@index')->name('admin.tools.AreaOfInterest.category.index');
                Route::get('/create', 'Admin\ToolsInterestCategoryController@create')->name('admin.tools.AreaOfInterest.category.create');
                Route::post('/store', 'Admin\ToolsInterestCategoryController@store')->name('admin.tools.AreaOfInterest.category.store');
                Route::get('/{id}/edit', 'Admin\ToolsInterestCategoryController@edit')->name('admin.tools.AreaOfInterest.category.edit');
                Route::post('/update', 'Admin\ToolsInterestCategoryController@update')->name('admin.tools.AreaOfInterest.category.update');
                Route::get('/{id}/delete', 'Admin\ToolsInterestCategoryController@delete')->name('admin.tools.AreaOfInterest.category.delete');
                Route::post('updateStatus', 'Admin\ToolsInterestCategoryController@updateStatus')->name('admin.tools.AreaOfInterest.category.updateStatus');
                Route::get('/{id}/details', 'Admin\ToolsInterestCategoryController@details')->name('admin.tools.AreaOfInterest.category.details');
               
            });

            //**   Area of Interest  **//
            Route::group(['prefix' => 'tools/AreaOfInterest'], function () {
                Route::get('/', 'Admin\ToolsInterestController@index')->name('admin.tools.AreaOfInterest.index');
                Route::get('/create', 'Admin\ToolsInterestController@create')->name('admin.tools.AreaOfInterest.create');
                Route::post('/store', 'Admin\ToolsInterestController@store')->name('admin.tools.AreaOfInterest.store');
                Route::get('/{id}/edit', 'Admin\ToolsInterestController@edit')->name('admin.tools.AreaOfInterest.edit');
                Route::post('/update', 'Admin\ToolsInterestController@update')->name('admin.tools.AreaOfInterest.update');
                Route::get('/{id}/delete', 'Admin\ToolsInterestController@delete')->name('admin.tools.AreaOfInterest.delete');
                Route::post('updateStatus', 'Admin\ToolsInterestController@updateStatus')->name('admin.tools.AreaOfInterest.updateStatus');
                Route::get('/{id}/details', 'Admin\ToolsInterestController@details')->name('admin.tools.AreaOfInterest.details');
                Route::post('/csv-store', 'Admin\ToolsInterestController@csvStore')->name('admin.tools.AreaOfInterest.data.csv.store');
                Route::get('/export', 'Admin\ToolsInterestController@export')->name('admin.tools.AreaOfInterest.data.csv.export');
            });

            // -------------------- Plans and Pricing-------------------------
            Route::group(['prefix'=>'plans-pricing'], function(){
                // Plans Pricing Master
                Route::group(['prefix' => '/management'], function () {
                    Route::get('/', 'Admin\PlansPriceController@index')->name('admin.plans.management.index');
                    Route::get('/create', 'Admin\PlansPriceController@create')->name('admin.plans.management.create');
                    Route::post('/store', 'Admin\PlansPriceController@store')->name('admin.plans.management.store');
                    Route::get('/{id}/edit', 'Admin\PlansPriceController@edit')->name('admin.plans.management.edit');
                    Route::post('/update', 'Admin\PlansPriceController@update')->name('admin.plans.management.update');
                    Route::post('/updatePricing', 'Admin\PlansPriceController@updatePricing')->name('admin.plans.management.updatePricing');
                    Route::get('{id}/deletePricing', 'Admin\PlansPriceController@deletePricing')->name('admin.plans.management.deletePricing');
                    Route::get('{id}/details', 'Admin\PlansPriceController@details')->name('admin.plans.management.details');
                    Route::get('/{id}/delete', 'Admin\PlansPriceController@delete')->name('admin.plans.management.delete');
                    Route::post('updateStatus', 'Admin\PlansPriceController@updateStatus')->name('admin.plans.management.updateStatus');
                });

                Route::group(['prefix' => '/page'], function () {
                    Route::get('/', 'Admin\PlansPricePageController@index')->name('admin.plans.page.index');
                    Route::get('/create', 'Admin\PlansPricePageController@create')->name('admin.plans.page.create');
                    Route::post('/store', 'Admin\PlansPricePageController@store')->name('admin.plans.page.store');
                    Route::get('/{id}/edit', 'Admin\PlansPricePageController@edit')->name('admin.plans.page.edit');
                    Route::post('/update', 'Admin\PlansPricePageController@update')->name('admin.plans.page.update');
                    Route::get('/{id}/details', 'Admin\PlansPricePageController@details')->name('admin.plans.page.details');
                });
            });

            //--------- Footer Management --------------//
           
            Route::group(['prefix' => 'footer'], function () {
                Route::get('/', 'Admin\FooterController@index')->name('admin.footer.content.index');
                Route::get('/{id}/edit', 'Admin\FooterController@edit')->name('admin.footer.content.edit');
                Route::post('/update', 'Admin\FooterController@update')->name('admin.footer.content.update');
                Route::get('/{id}/details', 'Admin\FooterController@details')->name('admin.footer.content.details');
            });

            //** Settings Management **/
            Route::group(['prefix' => 'settings'], function () {
                Route::get('/', 'Admin\SettingsController@index')->name('admin.settings.index');
                Route::get('/{id}/edit', 'Admin\SettingsController@edit')->name('admin.settings.edit');
                Route::post('/update', 'Admin\SettingsController@update')->name('admin.settings.update');
                Route::get('/{id}/details', 'Admin\SettingsController@details')->name('admin.settings.details');
               
            });

            
});