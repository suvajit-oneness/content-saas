<?php

use App\Http\Middleware\AuthenticateOnlyIfNotLoggedIn;
use App\Http\Middleware\RedirectToUSerLoginIfNotAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// login
Route::middleware([AuthenticateOnlyIfNotLoggedIn::class])->group(function () {
    Route::prefix('user/')->name('front.user.')->group(function () {
        Route::get('/user/register', 'Front\AuthController@register')->name('register');
        Route::post('/create', 'Front\AuthController@create')->name('create');
        Route::get('/login', 'Front\AuthController@login')->name('login');
        Route::post('/login/check', 'Front\AuthController@loginCheck')->name('login.check');
        // Route::get('logout', 'Front\AuthController@logout')->name('logout');
    });
});

// Route::get('logout', 'Front\AuthController@logout')->name('front.user.logout');

Route::name('front.')->group(function () {
    // homepage
    Route::get('/', 'Front\HomeController@index')->name('index');
    Route::get('/blog', 'Front\ArticleController@index')->name('article');
    Route::get('/blog/{slug}', 'Front\ArticleController@details')->name('article.details');
    // Route::get('/event',function(){
    //     dd("hi");
    // })->name('event');
    Route::get('/event', 'Front\EventController@index')->name('event');
    Route::get('/event/{slug}', 'Front\EventController@details')->name('event.details');
    Route::post('/event/calender', 'Front\EventController@calender')->name('event.calender');
    Route::get('/course', 'Front\CourseController@course')->name('course');
    Route::get('/course/{slug}', 'Front\CourseController@coursedetails')->name('course.details');

    // cart
    Route::get('/cart', 'Front\CartController@index')->name('cart');
    Route::post('/cart', 'Front\CartController@add')->name('cart.add');
    Route::get('/cart/remove/{id}', 'Front\CartController@delete')->name('cart.delete');
    Route::get('/checkout', 'Front\CheckoutController@index')->name('checkout.index');
    Route::post('/store', 'Front\CheckoutController@store')->name('checkout.store');
    Route::view('/complete', 'front.checkout.complete')->name('checkout.complete');

    //footer
    Route::get('/privacy-policy', 'Front\FrontController@privacy')->name('privacy');
    Route::get('/terms-condition', 'Front\FrontController@terms')->name('terms');

    //market
    Route::name('market.')->group(function () {
        Route::get('/market', 'Front\MarketController@index')->name('index');
    });

    // Deals
    Route::name('deals.')->group(function () {
        Route::get('/deals', 'Front\DealController@index')->name('index');
        Route::get('/deals/{slug}', 'Front\DealController@details')->name('detail');
    });

    //feature
    Route::name('feature.')->group(function () {
        Route::get('/tool', 'Front\FeatureController@index')->name('index');
    });

    //price
    Route::name('price.')->group(function () {
        Route::get('/pricing', 'Front\PriceController@index')->name('index');
    });

    //support
    Route::name('support.')->group(function () {
        Route::get('/support', 'Front\SupportController@index')->name('index');
    });

    //marketplace
    Route::name('marketplace.')->group(function () {
        Route::get('/marketplace', 'Front\MarketPlaceController@index')->name('index');
    });

    // portfolio in front
    Route::get('/portfolio/{slug}', 'Front\PortfolioController@index')->name('portfolio.index');

    Route::middleware([RedirectToUSerLoginIfNotAuthenticated::class])->group(function () {
        // User Logout
        Route::get('logout', 'Front\AuthController@logout')->name('user.logout');

        // portfolio in user management
        Route::prefix('user')->name('user.portfolio.')->group(function () {
            Route::get('portfolio/basic-details', 'Front\PortfolioController@edit')->name('index');
            Route::get('change/password', 'Front\PortfolioController@changePassword')->name('changePassword');
            Route::post('update/password', 'Front\PortfolioController@updatePassword')->name('updatePassword');
            Route::get('portfolio/basic-details/create', 'Front\Portfolio\ProfileController@create')->name('edit');
        });

        // User purchased course
        Route::prefix('user')->name('user.courses.')->group(function () {
            Route::get('/my-courses','Front\UserCourseController@index')->name('index');
            Route::get('/my-courses/{slug}','Front\UserCourseController@details')->name('details');
            Route::get('/my-courses/{slug}/{Lessonslug}','Front\UserCourseController@lessonDetails')->name('lesson');
            Route::get('/my-courses/{slug}/{Lessonslug}/{Topicslug}','Front\UserCourseController@topicDetails')->name('topic');
        });
            //user events
            Route::prefix('user')->name('user.events')->group(function () {
            Route::get('/my-events','Front\EventController@showMyEvents');
        });
        //user orders
        Route::prefix('user')->name('user.orders')->group(function () {
            Route::get('/my-orders','Front\OrderController@index');
        });

       


        Route::prefix('user')->name('user.profile.edit')->group(function () {
            Route::get('/update/profile','Front\Portfolio\ProfileController@editProfile');
        });

        // dashboard
        Route::name('dashboard.')->group(function () {
            Route::get('/dashboard', 'Front\DashboardController@index')->name('index');
        });

        // job
        Route::name('job.')->group(function () {
            Route::get('/job', 'Front\JobController@index')->name('index');
            Route::get('/job/{slug}', 'Front\JobController@details')->name('details');
            Route::post('/save/job', 'Front\JobController@store')->name('save');
            Route::post('/apply/job', 'Front\JobController@jobapply')->name('apply');
            Route::post('/job/interest/{id}', 'Front\JobController@jobinterest')->name('interest');
            Route::post('/job/report', 'Front\JobController@jobreport')->name('report');
        });

        // template
        Route::name('template.')->group(function () {
            Route::get('/template', 'Front\TemplateController@index')->name('index');
            Route::get('/template/{slug}', 'Front\TemplateController@details')->name('details');
            Route::post('/save/template', 'Front\TemplateController@store')->name('save');
        });

        // project
        Route::name('project.')->group(function () {
            Route::get('/project', 'Front\ProjectController@index')->name('index');
            Route::get('/project/create', 'Front\ProjectController@create')->name('create');
            Route::post('/project/store', 'Front\ProjectController@store')->name('store');
            Route::get('/project/{slug}', 'Front\ProjectController@detail')->name('detail');
            Route::get('/project/delete/{id}', 'Front\ProjectController@delete')->name('delete');
            Route::get('/project/edit/{id}', 'Front\ProjectController@edit')->name('edit');
            Route::post('/project/update/{id}', 'Front\ProjectController@update')->name('update');
            Route::post('/project/updatestatus', 'Front\ProjectController@updateStatus')->name('updateStatus');
            Route::post('/project/updateCommercial', 'Front\ProjectController@updateCommercial')->name('updateCommercial');
        });

        // project task
        Route::name('project.task.')->group(function () {
            Route::get('/project/{projectId}/task/create', 'Front\ProjectTaskController@create')->name('create');
            Route::post('/project/task/store', 'Front\ProjectTaskController@store')->name('store');
            Route::get('/project/task/{slug}', 'Front\ProjectTaskController@detail')->name('detail');
            Route::get('/project/task/delete/{id}', 'Front\ProjectTaskController@delete')->name('delete');
            Route::get('/project/task/edit/{id}', 'Front\ProjectTaskController@edit')->name('edit');
            Route::post('/project/task/update/{id}', 'Front\ProjectTaskController@update')->name('update');
            Route::post('/project/task/updatestatus', 'Front\ProjectTaskController@updateStatus')->name('updateStatus');
            Route::post('/project/task/updateCommercial', 'Front\ProjectTaskController@updateCommercial')->name('updateCommercial');
            Route::post('/project/task/comment/update/{id}', 'Front\ProjectTaskController@updateComment')->name('comment.update');
        });

        Route::prefix('user/post-content')->name('user.post-content.')->group(function(){
            Route::get('', 'Front\UserPostController@index')->name('index');
            Route::get('/create', 'Front\UserPostController@create')->name('create');
            Route::post('/store', 'Front\UserPostController@store')->name('store');
            Route::get('/edit/{id}', 'Front\UserPostController@edit')->name('edit');
            Route::post('/update', 'Front\UserPostController@update')->name('update');
            Route::get('/delete/{id}', 'Front\UserPostController@delete')->name('delete');
        });

        Route::prefix('user')->name('portfolio.')->group(function () {
            Route::name('profile.')->group(function () {
                Route::post('/basic-detail/update', 'Front\Portfolio\ProfileController@update')->name('update');
            });

            Route::name('expertise.')->group(function () {
                Route::get('/portfolio/expertise', 'Front\Portfolio\ExpertiseController@index')->name('index');
                Route::get('/portfolio/expertise/create', 'Front\Portfolio\ExpertiseController@create')->name('create');
                Route::post('/portfolio/expertise/store', 'Front\Portfolio\ExpertiseController@store')->name('store');
                Route::get('/portfolio/expertise/edit/{id}', 'Front\Portfolio\ExpertiseController@edit')->name('edit');
                Route::post('/portfolio/expertise/update', 'Front\Portfolio\ExpertiseController@update')->name('update');
                Route::get('/portfolio/expertise/delete/{id}', 'Front\Portfolio\ExpertiseController@delete')->name('delete');
            });

            Route::name('education.')->group(function () {
                Route::get('/portfolio/education', 'Front\Portfolio\EducationController@index')->name('index');
                Route::get('/portfolio/education/create', 'Front\Portfolio\EducationController@create')->name('create');
                Route::post('/portfolio/education/store', 'Front\Portfolio\EducationController@store')->name('store');
                Route::get('/portfolio/education/edit/{id}', 'Front\Portfolio\EducationController@edit')->name('edit');
                Route::post('/portfolio/education/update', 'Front\Portfolio\EducationController@update')->name('update');
                Route::get('/portfolio/education/delete/{id}', 'Front\Portfolio\EducationController@delete')->name('delete');
            });

            Route::name('work-experience.')->group(function () {
                Route::get('/portfolio/employment', 'Front\Portfolio\ExperienceController@index')->name('index');
                Route::get('/portfolio/employment/create', 'Front\Portfolio\ExperienceController@create')->name('create');
                Route::post('/portfolio/employment/store', 'Front\Portfolio\ExperienceController@store')->name('store');
                Route::get('/portfolio/employment/edit/{id}', 'Front\Portfolio\ExperienceController@edit')->name('edit');
                Route::post('/portfolio/employment/update', 'Front\Portfolio\ExperienceController@update')->name('update');
                Route::get('/portfolio/employment/delete/{id}', 'Front\Portfolio\ExperienceController@delete')->name('delete');
            });

            Route::name('work-category.')->group(function () {
                Route::get('/portfolio/work-category', 'Front\Portfolio\WorkCategoryController@index')->name('index');
                Route::get('/portfolio/work-category/create', 'Front\Portfolio\WorkCategoryController@create')->name('create');
                Route::post('/portfolio/work-category/store', 'Front\Portfolio\WorkCategoryController@store')->name('store');
                Route::get('/portfolio/work-category/edit/{id}', 'Front\Portfolio\WorkCategoryController@edit')->name('edit');
                Route::post('/portfolio/work-category/update', 'Front\Portfolio\WorkCategoryController@update')->name('update');
                Route::get('/portfolio/work-category/delete/{id}',    'Front\Portfolio\WorkCategoryController@delete')->name('delete');
            });

            Route::name('category.')->group(function () {
                Route::get('/portfolio/category', 'Front\Portfolio\CategoryController@index')->name('index');
                Route::get('/portfolio/category/create', 'Front\Portfolio\CategoryController@create')->name('create');
                Route::post('/portfolio/category/store', 'Front\Portfolio\CategoryController@store')->name('store');
                Route::get('/portfolio/category/edit/{id}', 'Front\Portfolio\CategoryController@edit')->name('edit');
                Route::post('/portfolio/category/update', 'Front\Portfolio\CategoryController@update')->name('update');
                Route::get('/portfolio/category/delete/{id}', 'Front\Portfolio\CategoryController@delete')->name('delete');
            });

            Route::name('portfolio.')->group(function () {
                Route::get('/portfolio', 'Front\Portfolio\PortfolioController@index')->name('index');
                Route::get('/portfolio/create', 'Front\Portfolio\PortfolioController@create')->name('create');
                Route::post('/portfolio/store', 'Front\Portfolio\PortfolioController@store')->name('store');
                Route::get('/portfolio/edit/{id}', 'Front\Portfolio\PortfolioController@edit')->name('edit');
                Route::post('/portfolio/update', 'Front\Portfolio\PortfolioController@update')->name('update');
                Route::get('/portfolio/delete/{id}', 'Front\Portfolio\PortfolioController@delete')->name('delete');
            });

            Route::name('client.')->group(function () {
                Route::get('/portfolio/client', 'Front\Portfolio\ClientController@index')->name('index');
                Route::get('/portfolio/client/add', 'Front\Portfolio\ClientController@create')->name('create');
                Route::post('/portfolio/client/store', 'Front\Portfolio\ClientController@store')->name('store');
                Route::get('/portfolio/client/edit/{id}', 'Front\Portfolio\ClientController@edit')->name('edit');
                Route::post('/portfolio/client/update', 'Front\Portfolio\ClientController@update')->name('update');
                Route::get('/portfolio/client/delete/{id}', 'Front\Portfolio\ClientController@delete')->name('delete');
            });

            Route::name('certification.')->group(function () {
                Route::get('/portfolio/certification', 'Front\Portfolio\CertificateController@index')->name('index');
                Route::get('/portfolio/certification/create', 'Front\Portfolio\CertificateController@create')->name('create');
                Route::post('/portfolio/certification/store', 'Front\Portfolio\CertificateController@store')->name('store');
                Route::get('/portfolio/certification/edit/{id}', 'Front\Portfolio\CertificateController@edit')->name('edit');
                Route::post('/portfolio/certification/update', 'Front\Portfolio\CertificateController@update')->name('update');
                Route::get('/portfolio/certification/delete/{id}', 'Front\Portfolio\CertificateController@delete')->name('delete');
            });

            Route::name('testimonial.')->group(function () {
                Route::get('/portfolio/testimonial', 'Front\Portfolio\TestimonialController@index')->name('index');
                Route::get('/portfolio/testimonial/create', 'Front\Portfolio\TestimonialController@create')->name('create');
                Route::post('/portfolio/testimonial/store', 'Front\Portfolio\TestimonialController@store')->name('store');
                Route::get('/portfolio/testimonial/edit/{id}', 'Front\Portfolio\TestimonialController@edit')->name('edit');
                Route::post('/portfolio/testimonial/update', 'Front\Portfolio\TestimonialController@update')->name('update');
                Route::get('/portfolio/testimonial/delete/{id}', 'Front\Portfolio\TestimonialController@delete')->name('delete');
            });
            Route::name('feedback.')->group(function () {
                Route::get('/portfolio/feedback', 'Front\Portfolio\FeedbackController@index')->name('index');
                Route::get('/portfolio/feedback/create', 'Front\Portfolio\FeedbackController@create')->name('create');
                Route::post('/portfolio/feedback/store', 'Front\Portfolio\FeedbackController@store')->name('store');
                Route::get('/portfolio/feedback/edit/{id}', 'Front\Portfolio\FeedbackController@edit')->name('edit');
                Route::post('/portfolio/feedback/update', 'Front\Portfolio\FeedbackController@update')->name('update');
                Route::get('/portfolio/feedback/delete/{id}', 'Front\Portfolio\FeedbackController@delete')->name('delete');
            });

        });
    });
});
