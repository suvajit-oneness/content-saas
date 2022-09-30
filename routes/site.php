<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// login
Route::middleware(['guest:web'])->name('front.')->group(function () {
    Route::prefix('user/')->name('user.')->group(function () {
        Route::get('/user/register', 'Front\AuthController@register')->name('register');
        Route::post('/create', 'Front\AuthController@create')->name('create');
        Route::get('/login', 'Front\AuthController@login')->name('login');
        Route::post('/login/check', 'Front\AuthController@loginCheck')->name('login.check');
        // Route::get('logout', 'Front\AuthController@logout')->name('logout');
    });
});

Route::get('logout', 'Front\AuthController@logout')->name('front.user.logout');

Route::name('front.')->group(function() {
    // homepage
    Route::get('/', 'Front\HomeController@index')->name('index');
    Route::get('/article', 'Front\ArticleController@article')->name('article');
    Route::get('/article/{slug}', 'Front\ArticleController@articledetails')->name('article.details');
    Route::get('/event', 'Front\EventController@event')->name('event');
    Route::get('/event/{slug}', 'Front\EventController@eventdetails')->name('event.details');
    Route::get('/course', 'Front\CourseController@course')->name('course');
    Route::get('/course/{slug}', 'Front\CourseController@coursedetails')->name('course.details');

    // cart
    Route::get('/cart', 'Front\CartController@index')->name('cart');
    Route::post('/cart', 'Front\CartController@add')->name('cart.add');
    Route::get('/cart/remove/{id}', 'Front\CartController@delete')->name('cart.delete');
    Route::get('/checkout', 'Front\CheckoutController@index')->name('checkout.index');
    Route::post('/store', 'Front\CheckoutController@store')->name('checkout.store');
    Route::view('/complete', 'front.checkout.complete')->name('checkout.complete');

    //market
    Route::name('market.')->group(function () {
        Route::get('/market', 'Front\MarketController@index')->name('index');
    });

    //feature
    Route::name('feature.')->group(function () {
        Route::get('/feature', 'Front\FeatureController@index')->name('index');
    });

    //price
    Route::name('price.')->group(function () {
        Route::get('/price', 'Front\PriceController@index')->name('index');
    });

    //support
    Route::name('support.')->group(function () {
        Route::get('/support', 'Front\SupportController@index')->name('index');
    });

    //marketplace
    Route::name('marketplace.')->group(function () {
        Route::get('/marketplace', 'Front\MarketPlaceController@index')->name('index');
    });

    // dashboard
    Route::name('dashboard.')->group(function () {
        Route::get('/dashboard', 'Front\DashboardController@index')->name('index');
    });

    // portfolio in front
    Route::get('/portfolio/{slug}', 'Front\PortfolioController@index')->name('portfolio.index');

    // portfolio in user management
    Route::prefix('user/portfolio')->name('user.portfolio.')->group(function() {
        Route::get('manage', 'Front\PortfolioController@edit')->name('manage');

        Route::get('basic-details/{slug}', 'Front\Portfolio\ProfileController@create')->name('manage.basic-details.edit');
    });

    // Route::get('/user/portfolio/manage/{slug}', 'Front\PortfolioController@edit')->name('portfolio.edit');
    Route::name('portfolio.')->group(function () {
        Route::name('profile.')->group(function () {
            Route::get('/basic-detail/create/{slug}', 'Front\Portfolio\ProfileController@create')->name('create');
            Route::post('/basic-detail/update', 'Front\Portfolio\ProfileController@update')->name('update');
        });

        Route::name('expertise.')->group(function () {
            Route::get('/expertise/add', 'Front\Portfolio\ExpertiseController@create')->name('create');
            Route::post('/expertise/store', 'Front\Portfolio\ExpertiseController@store')->name('store');
            Route::get('/expertise/edit/{id}', 'Front\Portfolio\ExpertiseController@edit')->name('edit');
            Route::post('/expertise/update', 'Front\Portfolio\ExpertiseController@update')->name('update');
            Route::get('/expertise/delete/{id}', 'Front\Portfolio\ExpertiseController@delete')->name('delete');
        });

        Route::name('education.')->group(function () {
            Route::get('/education/add', 'Front\Portfolio\EducationController@create')->name('create');
            Route::post('/education/store', 'Front\Portfolio\EducationController@store')->name('store');
            Route::get('/education/edit/{id}', 'Front\Portfolio\EducationController@edit')->name('edit');
            Route::post('/education/update', 'Front\Portfolio\EducationController@update')->name('update');
            Route::get('/education/delete/{id}', 'Front\Portfolio\EducationController@delete')->name('delete');
        });

        Route::name('work-experience.')->group(function () {
            Route::get('/work-experience/add', 'Front\Portfolio\ExperienceController@create')->name('create');
            Route::post('/work-experience/store', 'Front\Portfolio\ExperienceController@store')->name('store');
            Route::get('/work-experience/edit/{id}', 'Front\Portfolio\ExperienceController@edit')->name('edit');
            Route::post('/work-experience/update', 'Front\Portfolio\ExperienceController@update')->name('update');
            Route::get('/work-experience/delete/{id}', 'Front\Portfolio\ExperienceController@delete')->name('delete');
        });

        Route::name('work-category.')->group(function () {
            Route::get('/work-category/add', 'Front\Portfolio\WorkCategoryController@create')->name('create');
            Route::post('/work-category/store', 'Front\Portfolio\WorkCategoryController@store')->name('store');
            Route::get('/work-category/edit/{id}', 'Front\Portfolio\WorkCategoryController@edit')->name('edit');
            Route::post('/work-category/update', 'Front\Portfolio\WorkCategoryController@update')->name('update');
            Route::get('/work-category/delete/{id}', 'Front\Portfolio\WorkCategoryController@delete')->name('delete');
        });

        Route::name('category.')->group(function () {
            Route::get('/category/add', 'Front\Portfolio\CategoryController@create')->name('create');
            Route::post('/category/store', 'Front\Portfolio\CategoryController@store')->name('store');
            Route::get('/category/edit/{id}', 'Front\Portfolio\CategoryController@edit')->name('edit');
            Route::post('/category/update', 'Front\Portfolio\CategoryController@update')->name('update');
            Route::get('/category/delete/{id}', 'Front\Portfolio\CategoryController@delete')->name('delete');
        });

        Route::name('portfolio.')->group(function () {
            Route::get('/user/portfolio/add', 'Front\Portfolio\PortfolioController@create')->name('create');
            Route::post('/portfolio/store', 'Front\Portfolio\PortfolioController@store')->name('store');
            Route::get('/portfolio/edit/{id}', 'Front\Portfolio\PortfolioController@edit')->name('edit');
            Route::post('/portfolio/update', 'Front\Portfolio\PortfolioController@update')->name('update');
            Route::get('/portfolio/delete/{id}', 'Front\Portfolio\PortfolioController@delete')->name('delete');
        });

        Route::name('client.')->group(function () {
            Route::get('/client/add', 'Front\Portfolio\ClientController@create')->name('create');
            Route::post('/client/store', 'Front\Portfolio\ClientController@store')->name('store');
            Route::get('/client/edit/{id}', 'Front\Portfolio\ClientController@edit')->name('edit');
            Route::post('/client/update', 'Front\Portfolio\ClientController@update')->name('update');
            Route::get('/client/delete/{id}', 'Front\Portfolio\ClientController@delete')->name('delete');
        });

        Route::name('certification.')->group(function () {
            Route::get('/certification/add', 'Front\Portfolio\CertificateController@create')->name('create');
            Route::post('/certification/store', 'Front\Portfolio\CertificateController@store')->name('store');
            Route::get('/certification/edit/{id}', 'Front\Portfolio\CertificateController@edit')->name('edit');
            Route::post('/certification/update', 'Front\Portfolio\CertificateController@update')->name('update');
            Route::get('/certification/delete/{id}', 'Front\Portfolio\CertificateController@delete')->name('delete');
        });

        Route::name('testimonial.')->group(function () {
            Route::get('/testimonial/add', 'Front\Portfolio\TestimonialController@create')->name('create');
            Route::post('/testimonial/store', 'Front\Portfolio\TestimonialController@store')->name('store');
            Route::get('/testimonial/edit/{id}', 'Front\Portfolio\TestimonialController@edit')->name('edit');
            Route::post('/testimonial/update', 'Front\Portfolio\TestimonialController@update')->name('update');
            Route::get('/testimonial/delete/{id}', 'Front\Portfolio\TestimonialController@delete')->name('delete');
        });
    });
});
