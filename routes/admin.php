<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Admin\BlankController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Setting\AppDbBackupController;
use App\Http\Controllers\Setting\Permission\RoleController;
use App\Http\Controllers\Setting\Permission\PermissionController;

Route::resource('blank', BlankController::class)->except(['store','edit', 'update','delete']);

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


// Global Ajax
Route::delete('/delete-all/{model}', [AjaxController::class, 'deleteAll'])->name('delete_all');
Route::delete('/force-delete-all/{model}', [AjaxController::class, 'forceDeleteAll'])->name('force_delete_all');
Route::get('/select-2-ajax/{model}', [AjaxController::class, 'select2'])->name('select2');

// Role & Permission
Route::post('/role/permission/{role}', [RoleController::class, 'assignPermission'])->name('role.permission');
Route::resource('/role', RoleController::class);
Route::resource('/permission', PermissionController::class);

// App DB Backup
Route::controller(AppDbBackupController::class)->prefix('app-db-backup')->group(function(){
    Route::get('/password', 'password')->name('backup.password');
    Route::post('/checkPassword', 'checkPassword')->name('backup.checkPassword');
    Route::get('/confirm', 'index')->name('backup.index');
    Route::post('/backup-file', 'backupFiles')->name('backup.files');
    Route::post('/backup-db', 'backupDb')->name('backup.db');
    Route::post('/backup-download/{name}/{ext}', 'downloadBackup')->name('backup.download');
    Route::post('/backup-delete/{name}/{ext}', 'deleteBackup')->name('backup.delete');
});

Route::resource('/admin-user', AdminUserController::class,['parameters' => ['admin-user' => 'admin_user']])->except(['show','create']);

Route::resource('/category', CategoryController::class)->except(['show','create']);
Route::resource('/sub-category', SubCategoryController::class,['parameters' => ['sub-category' => 'sub_category']])->except(['show','create']);
Route::resource('/product', ProductController::class)->except(['show','create']);
Route::get('/get-Sub-category', [ProductController::class, 'getSubCategory'])->name('getSubCategory');
Route::resource('/slider', SliderController::class)->except(['show','create']);
Route::resource('/order', OrderController::class)->except(['show','create','store','edit','update','destroy']);
Route::resource('/stock', StockController::class)->except(['show','create','store','edit','update','destroy']);
