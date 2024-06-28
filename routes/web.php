<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetSessionData;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Backends\BookController;
use App\Http\Controllers\Backends\UserController;
use App\Http\Controllers\Backends\BorrowController;
use App\Http\Controllers\Backends\ReportController;
use App\Http\Controllers\Backends\CatelogController;
use App\Http\Controllers\Backends\CustomerController;
use App\Http\Controllers\Backends\PermissionController;
use App\Http\Controllers\Backends\CustomerTypeController;
use App\Http\Controllers\Backends\BusinessSettingController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    $language = \App\Models\BusinessSetting::first()->language;
    session()->put('language_settings', $language);
    return redirect()->back();
})->name('change_language');

Auth::routes();
Route::middleware(['auth', SetSessionData::class, 'local_lang', 'default_lang'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all_permission', 'AllRole')->name('role.index');
        Route::get('/add_permission', 'AddRole')->name('add_role');
        Route::post('/store_permission', 'StoreRole')->name('store_role');
        Route::get('/edit_role/{id}', 'EditRole')->name('edit_role');
        Route::put('/update_role/{id}', 'UpdateRole')->name('update_role');
        Route::delete('/delete/{id}', 'DestroyRole')->name('destroy_role');
    });
    //User
    Route::resource('user', UserController::class);
    Route::get('profile/edit/{id}', [UserController::class, 'edit_profile'])->name('profile.edit');
    Route::put('profile/update/{id}', [UserController::class, 'update_profile'])->name('profile.update');
    //Catelogs
    Route::resource('catelog', CatelogController::class);
    Route::post('/update-status-catelog', [CatelogController::class, 'updateStatus'])->name('catelog.status-update');
    //Books
    Route::resource('book', BookController::class);
    Route::post('/update-status', [BookController::class, 'updateStatus'])->name('book.update_status');
    //Customer Type
    Route::resource('customer_type', CustomerTypeController::class);
    //Customer
    Route::resource('customer', CustomerController::class);
    Route::post('/update-status-customer', [CustomerController::class, 'updateStatus'])->name('customer.status_update');
    //Borrow
    Route::resource('/borrow', BorrowController::class);
    Route::get('/fetch-books/{cate_id}', [BorrowController::class, 'fetchBooks']);
    Route::get('/fetch-books-edit/{cate_id}', [BorrowController::class, 'EditfetchBooks']);
    Route::put('/input-return-date/{id}', [BorrowController::class, 'return_book'])->name('return.input');
    Route::get('/is_return', [BorrowController::class, 'is_return'])->name('is_return.index');
    Route::get('/is-return/show/{id}', [BorrowController::class, 'showIs_return'])->name('is_return.show');

    //Report
    Route::get('borrow-report', [ReportController::class, 'index'])->name('report.index');
    Route::get('book-report', [ReportController::class, 'book_report'])->name('book_report.index');
    Route::get('customer-report', [ReportController::class, 'customer_report'])->name('customer_report.index');
    Route::get('/report', [ReportController::class, 'customerReport'])->name('report.customer');
    Route::post('/send-telegram-notification/{borrow}', [BorrowController::class, 'sendTelegramNotification'])->name('send.telegram.notification');


    //Business Setting
    Route::get('business-setting', [BusinessSettingController::class, 'index'])->name('business_setting.index');
    Route::put('update-business-setting', [BusinessSettingController::class, 'update'])->name('business_setting.update');

});
