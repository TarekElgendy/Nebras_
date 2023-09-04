<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AdsController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InboxController;
use App\Http\Controllers\Dashboard\MajorCategoryController;
use App\Http\Controllers\Dashboard\MajorController;
use App\Http\Controllers\Dashboard\OfferController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProductitemController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\StateController;
use App\Http\Controllers\Dashboard\TimelineController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\WalletController;

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.',  'middleware' => 'auth:admin'], function () {

            Route::get('/index', [DashboardController::class, 'index'])->name('index');
            Route::resource('settings', SettingController::class)->except(['show']);

            Route::resource('inboxs', InboxController::class)->except(['show']);
            Route::get('/inboxs/export/', [InboxController::class, 'export'])->name('inboxs.export');


            Route::resource('countries', CountryController::class);
            Route::resource('states', StateController::class);
            Route::resource('cities', CityController::class);


            Route::resource('brands', BrandController::class);
            Route::resource('ads', AdsController::class);
            Route::resource('sections', SectionController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('products', ProductController::class);
            Route::get('/products/duplicate/{id?}', [ProductController::class, 'duplicate'])->name('products.duplicate');
            Route::get('/products/image_delete/{id?}', [ProductController::class, 'image_delete'])->name('products.image_delete');

            Route::resource('productitems', ProductitemController::class);
            Route::get('/productitems/duplicate/{id?}', [ProductitemController::class, 'duplicate'])->name('productitems.duplicate');

            Route::resource('pages', PageController::class);
            Route::get('/pages/duplicate/{id?}', [PageController::class, 'duplicate'])->name('pages.duplicate');


            Route::get('/users/export/', [UserController::class, 'export'])->name('users.export');
            Route::resource('users', UserController::class);



            Route::resource('majors', MajorController::class);
            Route::resource('majorCategories', MajorCategoryController::class);


            Route::resource('orders', OrderController::class);
            Route::resource('offers', OfferController::class);
            Route::resource('wallets', WalletController::class);
            Route::resource('timeLines', TimelineController::class);



            //####################### start Admins routes ########################
            Route::resource('permissions', PermissionController::class);
            Route::resource('roles', RoleController::class)->except(['show']);
            Route::resource('admins', AdminController::class);
            //####################### End  Admins routes ########################

            #profile
            Route::get('logout', [DashboardController::class, 'logout'])->name('logout');
            Route::resource('profile', ProfileController::class);
        }); //end of dashboard routes
    }
);
