<?php

use App\Http\Controllers\Backend\BCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\AuthenticationController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PoliciesController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ServicesController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\TranslationController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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




// Authentication routes
Route::controller(AuthenticationController::class)->group(function () {
    Route::group(['middleware' => ['guest']], function() {
        Route::get('login', 'show')->name('login');
        Route::post('login', 'login')->name('login');

    });
    Route::post('logout', 'logout')->name('logout');
});


Route::get('admin',function(){
    return redirect()->route('dashboard');
});

Route::get('dashboard',function(){
    return redirect()->route('dashboard');
});

Route::group(['middleware' => 'auth','prefix' => LaravelLocalization::setLocale().'/admin'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function () {
        Route::get('edit','edit')->name('edit');
        Route::put('update', 'updateProfile')->name('updateProfile');

    });

    Route::post('sliders/bulk_delete', [SlidersController::class,'bulkDestroy'])->name('sliders.destroy.all');
    Route::resource('sliders', SlidersController::class);

    Route::post('banners/bulk_delete', [BannerController::class,'bulkDestroy'])->name('banners.destroy.all');
    Route::resource('banners', BannerController::class);


    Route::controller(ContactController::class)->prefix('contact-us')->as('contacts.')->group(function () {
        Route::get('/','index')->name('index');
        Route::get('show/{id?}', 'show')->name('show');
        Route::get('update-status/{id}/{status}', 'updateStatus')->name('updateStatus');
        Route::delete('{id?}', 'destroy')->name('destroy');
        Route::post('destroy-all/{ids?}', 'bulkDestroy')->name('destroy.all');

    });


    Route::controller(SettingsController::class)->prefix('settings')->as('settings.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('update', 'updateSettings')->name('update');
        Route::delete('{id?}', 'destroy')->name('destroy');
        Route::get('/sitemap', 'sitemap')->name('sitemap');
    });


    Route::post('services/destroy-all/{ids?}', [ServicesController::class,'bulkDestroy'])->name('services.destroy.all');
    Route::resource('services', ServicesController::class);


    Route::post('partners/destroy-all/{ids?}', [PartnerController::class,'bulkDestroy'])->name('partners.destroy.all');
    Route::resource('partners', PartnerController::class);



    Route::controller(AboutUsController::class)->prefix('about_us')->as('about_us.')->group(function () {
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
    });

    Route::prefix('blogs')->as('blogs.')->group(function () {

        // bull destroy for blogs
        Route::post('destroy-all/{ids?}', [BlogController::class,'bulkDestroy'])->name('destroy.all');

        Route::resource('categories', BCategoryController::class);
        Route::post('categories/destroy-all/{ids?}', [BCategoryController::class,'bulkDestroy'])->name('categories.destroy.all');
    });

    Route::resource('blogs', BlogController::class);

    Route::resource('policies', PoliciesController::class);
    Route::post('policies/destroy-all/{ids?}', [BlogController::class,'bulkDestroy'])->name('policies.destroy.all');



    Route::controller(TranslationController::class)->prefix('translations')->as('translations.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/show/{lang}', 'show')->name('show');
        Route::post('/update/{id}', 'update')->name('update');
    });


    Route::prefix('roles')->as('roles.')->group(function () {
        // bull destroy for permissions
        Route::post('destroy-all/{ids?}', [PermissionController::class,'bulkDestroy'])->name('permissions.destroy.all');
        Route::resource('permissions', PermissionController::class);

    });

    Route::prefix('testimonial')->as('testimonial.')->controller(TestimonialController::class)->group(function (){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::put('update/{id}','update')->name('update');
        Route::delete('destroy/{id}','destroy')->name('destroy');
    });

    Route::resource('users', UserController::class);
    Route::post('users/{ids?}', [UserController::class,'bulkDestroy'])->name('users.destroy.all');


    Route::resource('roles', RoleController::class);
    Route::post('roles/{ids?}', [RoleController::class,'bulkDestroy'])->name('roles.destroy.all');


});

