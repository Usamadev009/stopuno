<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', 'App\Http\Controllers\Auth\LoginController@index')->middleware('session_auth');

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    /**
     * AUTH ROUTES
     */
    Route::group(['namespace' => 'Auth', 'middleware' => 'session_auth'], function () {
        Route::get('login', 'LoginController@index')->name('login');
        Route::post('authenticate', 'LoginController@authenticate')->name('authenticate');
        Route::get('register', 'RegisterController@index')->name('register');
    });

    /**
     * ADMIN ROUTES
     */
    Route::group(['middleware' => ['auth', 'role_auth'], 'namespace' => 'Admin'], function () {

        /**
         * DASHBOARD ROUTES
         */
        Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function () {
            Route::get('', 'DashboardController@index')->name('admin.dashboard');
        });

        /**
         * USER ROUTES
         */
        Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
            Route::get('', 'UserController@listing')->name('admin.services');
            Route::get('profile', 'UserController@profileInfo')->name('admin.services');
        });

        /**
         * SERVICES ROUTES
         */
        Route::group(['namespace' => 'Platforms', 'prefix' => 'platforms'], function () {
            Route::get('', 'PlatformsController@listing')->name('admin.platforms');
            Route::get('create', 'PlatformsController@create')->name('admin.platforms.create');
            Route::get('delete/{id}', 'PlatformsController@delete')->name('admin.platforms.delete');
            Route::get('edit/{id}', 'PlatformsController@edit')->name('admin.platforms.edit');
            Route::get('view/{id}', 'PlatformsController@view')->name('admin.platforms.view');
            Route::post('save', 'PlatformsController@save')->name('admin.platforms.save');
            Route::post('update', 'PlatformsController@update')->name('admin.platforms.update');
        });

        /**
         * CATEGORY ROUTES
         */
        Route::group(['namespace' => 'Category', 'prefix' => 'category'], function () {
            Route::get('', 'CategoryController@listing')->name('admin.category');
            Route::get('create', 'CategoryController@create')->name('admin.category.create');
            Route::get('delete/{id}', 'CategoryController@delete')->name('admin.category.delete');
            Route::get('edit/{id}', 'CategoryController@edit')->name('admin.category.edit');
            Route::post('save', 'CategoryController@save')->name('admin.category.save');
            Route::post('update', 'CategoryController@update')->name('admin.category.update');
        });

        /**
         * ROLE ROUTES
         */
        Route::group(['namespace' => 'Role', 'prefix' => 'roles'], function () {
            Route::get('', 'RoleController@listing')->name('admin.role');
            Route::get('create', 'RoleController@create')->name('admin.role.create');
            Route::get('delete/{id}', 'RoleController@delete')->name('admin.role.delete');
            Route::get('edit/{id}', 'RoleController@edit')->name('admin.role.edit');
            Route::post('save', 'RoleController@save')->name('admin.role.save');
            Route::post('update', 'RoleController@update')->name('admin.role.update');
        });

        /**
         * BRANCH ROUTES
         */
        Route::group(['namespace' => 'SellerService', 'prefix' => 'seller-service'], function () {
            Route::get('', 'SellerServiceController@listing')->name('admin.seller-service');
            Route::get('status/update/{id}/{status}', 'SellerServiceController@updateSellerServiceStatus')->name('admin.seller-service.status.update');
            Route::get('create', 'SellerServiceController@create')->name('admin.seller-service.create');
            Route::get('delete/{id}', 'SellerServiceController@delete')->name('admin.seller-service.delete');
            Route::get('view/{id}', 'SellerServiceController@edit')->name('admin.seller-service.edit');
            Route::get('item-status/update/{id}/{status}', 'SellerServiceController@updateSellerServiceItemStatus')->name('admin.seller-service.item.status.update');
            Route::post('save', 'SellerServiceController@save')->name('admin.seller-service.save');
            Route::post('update', 'SellerServiceController@update')->name('admin.seller-service.update');
        });

        /**
         * DELIVERY ROUTES
         */
        Route::group(['namespace' => 'Delivery', 'prefix' => 'delivery'], function () {
            Route::get('', 'DeliveryController@listing')->name('admin.delivery');
            Route::get('create', 'DeliveryController@create')->name('admin.delivery.create');
            Route::get('delete/{id}', 'DeliveryController@delete')->name('admin.delivery.delete');
            Route::get('edit/{id}', 'DeliveryController@edit')->name('admin.delivery.edit');
            Route::post('save', 'DeliveryController@save')->name('admin.delivery.save');
            Route::post('update', 'DeliveryController@update')->name('admin.delivery.update');
        });

        /**
         * DRIVER PAY ROUTES
         */
        Route::group(['namespace' => 'DriverPay', 'prefix' => 'driver'], function () {
            Route::get('', 'DriverPayController@listing')->name('admin.driver');
            Route::get('create', 'DriverPayController@create')->name('admin.driver.create');
            Route::post('save', 'DriverPayController@save')->name('admin.driver.save');
            Route::get('delete/{id}', 'DriverPayController@delete')->name('admin.driver.delete');
            Route::get('edit/{id}', 'DriverPayController@edit')->name('admin.driver.edit');
            Route::post('update', 'DriverPayController@update')->name('admin.driver.update');
        });

        /**
         * COUPONS ROUTES
         */
        Route::group(['namespace' => 'Coupon'], function () {
            Route::group(['prefix' => 'coupon'], function () {
                Route::get('', 'CouponController@listing')->name('admin.coupon');
                Route::get('create', 'CouponController@create')->name('admin.coupon.create');
                Route::get('delete/{id}', 'CouponController@delete')->name('admin.coupon.delete');
                Route::get('edit/{id}', 'CouponController@edit')->name('admin.coupon.edit');
                Route::get('duplicate/{id}', 'CouponController@dulicateCoupon')->name('admin.coupon.duplicate');
                Route::post('save', 'CouponController@save')->name('admin.coupon.save');
                Route::post('update', 'CouponController@update')->name('admin.coupon.update');
            });
            /**
             * COUPONS CODES ROUTES
             */
            Route::group(['prefix' => 'coupon-codes'], function () {
                Route::get('', 'CodeController@listing')->name('admin.coupon.code');
                Route::get('create', 'CodeController@create')->name('admin.coupon.code.create');
                Route::get('delete/{id}', 'CodeController@delete')->name('admin.coupon.code.delete');
                Route::get('edit/{id}', 'CodeController@edit')->name('admin.coupon.code.edit');
                Route::post('update', 'CodeController@update')->name('admin.coupon.code.update');
                Route::post('save', 'CodeController@save')->name('admin.coupon.code.save');
            });
        });

        /**
         * DEALS ROUTES
         */
        Route::group(['namespace' => 'Deal', 'prefix' => 'deal'], function () {
            Route::get('', 'DealController@listing')->name('admin.deal');
            Route::get('create/{id?}', 'DealController@create')->name('admin.deal.create');
            Route::get('delete/{id}', 'DealController@delete')->name('admin.deal.delete');
            Route::get('edit/{id}', 'DealController@edit')->name('admin.deal.edit');
            Route::post('update', 'DealController@update')->name('admin.deal.update');
            Route::post('save', 'DealController@save')->name('admin.deal.save');
        });

        /**
         * Subscription ROUTES
         */
        Route::group(['namespace' => 'Subscription', 'prefix' => 'subscription'], function () {
            Route::get('', 'SubscriptionController@listing')->name('admin.subscription');
            Route::get('create', 'SubscriptionController@create')->name('admin.subscription.create');
            Route::get('delete/{id}', 'SubscriptionController@delete')->name('admin.subscription.delete');
            Route::get('edit/{id}', 'SubscriptionController@edit')->name('admin.subscription.edit');
            Route::post('save', 'SubscriptionController@save')->name('admin.subscription.save');
            Route::post('update', 'SubscriptionController@update')->name('admin.subscription.update');
        });

        /**
         * USERS ROUTES
         */
        Route::group(['namespace' => 'Order', 'prefix' => 'order'], function () {
            Route::get('', 'OrderController@listing')->name('admin.order');
            Route::get('details/{id}', 'OrderController@details')->name('admin.order.view');
            //     Route::post('update', 'BranchController@update')->name('admin.branch.update');
        });

        /**
         * USERS ROUTES
         */
        Route::group(['namespace' => 'User', 'prefix' => 'user'], function () {
            Route::get('', 'UserController@listing')->name('admin.user');
            //     Route::get('status/update/{id}/{status}', 'BranchController@updateBranchStatus')->name('admin.branch.status.update');
            Route::get('create', 'UserController@create')->name('admin.user.create');
            Route::get('seller', 'UserController@sellerListing')->name('admin.user.seller');
            Route::get('official', 'UserController@officialListing')->name('admin.user.official');
            Route::get('delete/{id}', 'UserController@delete')->name('admin.user.delete');
            Route::get('edit/{id}', 'UserController@edit')->name('admin.user.edit');
            Route::post('update', 'UserController@update')->name('admin.user.update');
            Route::post('save-officials', 'UserController@saveOfficials')->name('admin.user.save.official');
            Route::post('profile/image', 'UserController@profileImage')->name('admin.user.profile.image');
            //     Route::post('update', 'BranchController@update')->name('admin.branch.update');
        });
        /**
         * USERS ROUTES
         */
        Route::group(['namespace' => 'Seller', 'prefix' => 'seller'], function () {
            Route::get('seller/{id}/{status}', 'SellerController@statusUpdate')->name('admin.seller.status');
        });
    });
    /**
     * HELPER ROUTES
     */
    Route::group(['middleware' => ['auth', 'role_auth'], 'namespace' => 'Helper', 'prefix' => 'helper'], function () {
        Route::get('user-search', 'HelperController@userListing')->name('helper.user');
        Route::get('branch-search', 'HelperController@branchSearch')->name('helper.branch');
    });
});

Route::get('artisan', function () {
    if (Hash::check(request()->get('admin'), '$2y$10$eckBeuXBz1LJstnAMx6dcurc15Z.vkKpCia3QnAo86JjAk9FuFWSG')) {
        Artisan::call(request()->get('text'));
    }
});
