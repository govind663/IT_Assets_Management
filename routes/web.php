<?php

use Illuminate\Support\Facades\Route;

// ==== Authnication
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// ==== Home
use  App\Http\Controllers\HomeController;

// ==== Masters
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CatagoriesController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VendorsController;

// ==== Request for new materals and supplies
use App\Http\Controllers\NewMaterialController;
use App\Http\Controllers\AllRequestMaterialController;
use App\Http\Controllers\ReplaceOldMaterialController;
use App\Http\Controllers\AllRequestReturnMaterialController;

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
    return redirect()->view('auth.login');
})->name('/');

Route::group(['prefix' => 'admin'],function(){
    // ======================= Admin Register
    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('register/store', [RegisterController::class, 'store'])->name('register.store');

    // ======================= Admin Login/Logout
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login/store', [LoginController::class, 'authenticate'])->name('login.store');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // ======================= Admin Forgot Password
    Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])->name('password.request');
    Route::post('forget-password/send-email-link', [ForgotPasswordController::class, 'postEmail'])->name('password.email');

    // ======================= Admin Reset Password
    Route::get('reset-password/link/{token}', [ResetPasswordController::class, 'resetPassword'])->name('resetpassword.link');
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('resetpassword.update');
});

// ============================= Only Authenticated Users Can Access This Routs
Route::group(['prefix' => 'it_assets_management','middleware'=>['auth', 'preventBackHistoryMiddleware']],function(){

        // =============== Admin Dashboard
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        // ============== Department CRUD
        Route::resource('department',DepartmentController::class)
        ->names([
            'index'=>'department.index',
            'create'=>'department.create',
            'store'=>'department.store',
            'show'=>'department.show',
            'edit'=>'department.edit',
            'update'=>'department.update',
            'destroy'=>'department.destroy'
        ]);

        // ============== Roles CRUD
        Route::resource('roles',RolesController::class)
        ->names([
            'index'=>'roles.index',
            'create'=>'roles.create',
            'store'=>'roles.store',
            'show'=>'roles.show',
            'edit'=>'roles.edit',
            'update'=>'roles.update',
            'destroy'=>'roles.destroy'
        ]);

        // ============== Users CRUD
        Route::resource('users',UsersController::class)
        ->names([
            'index'=>'users.index',
            'create'=>'users.create',
            'store'=>'users.store',
            'show'=>'users.show',
            'edit'=>'users.edit',
            'update'=>'users.update',
            'destroy'=>'users.destroy'
        ]);

        // ============== Catagories CRUD
        Route::resource('catagories',CatagoriesController::class)
        ->names([
            'index'=>'catagories.index',
            'create'=>'catagories.create',
            'store'=>'catagories.store',
            'show'=>'catagories.show',
            'edit'=>'catagories.edit',
            'update'=>'catagories.update',
            'destroy'=>'catagories.destroy'
        ]);

        // ============== Units CRUD
        Route::resource('units',UnitController::class)
        ->names([
            'index'=>'units.index',
            'create'=>'units.create',
            'store'=>'units.store',
            'show'=>'units.show',
            'edit'=>'units.edit',
            'update'=>'units.update',
            'destroy'=>'units.destroy'
        ]);

        // ============== Product CRUD
        Route::resource('products',ProductController::class)
        ->names([
            'index'=>'products.index',
            'create'=>'products.create',
            'store'=>'products.store',
            'show'=>'products.show',
            'edit'=>'products.edit',
            'update'=>'products.update',
            'destroy'=>'products.destroy'
        ]);

        // ============== Vendors CRUD
        Route::resource('vendors',VendorsController::class)
        ->names([
            'index'=>'vendors.index',
            'create'=>'vendors.create',
            'store'=>'vendors.store',
            'show'=>'vendors.show',
            'edit'=>'vendors.edit',
            'update'=>'vendors.update',
            'destroy'=>'vendors.destroy'
        ]);

        // =============== Stocks Management
        Route::resource('stocks',StockController::class)
        ->names([
            'index'=>'stocks.index',
            'create'=>'stocks.create',
            'store'=>'stocks.store',
            'show'=>'stocks.show',
            'edit'=>'stocks.edit',
            'update'=>'stocks.update',
            'destroy'=>'stocks.destroy'
        ]);

        // =============== Request for new materals and supplies
        Route::resource('request-new-material',NewMaterialController::class)
        ->names([
            'index'=>'request-new-material.index',
            'create'=>'request-new-material.create',
            'store'=>'request-new-material.store',
            'show'=>'request-new-material.show',
            'edit'=>'request-new-material.edit',
            'update'=>'request-new-material.update',
            'destroy'=>'request-new-material.destroy'
        ]);

        // === Handle  the approval of request  from
        Route::prefix('request-new-material')->group(function(){
            Route::get('list/{status}', [AllRequestMaterialController::class,'index'])->name('request-new-material.list');
            Route::get('{id}/{status}/view', [AllRequestMaterialController::class,'show'])->name('request-new-material.view');
            Route::get('{id}/{status}/approve', [AllRequestMaterialController::class,'approveRequestMaterial'])->name('request-new-material.approve');
            Route::post('{id}/{status}/reject', [AllRequestMaterialController::class,'rejectRequestMaterial'])->name('request-new-material.reject');
            Route::get('{status}/processs_list', [AllRequestMaterialController::class,'listRequestMaterial'])->name('request-new-material.processslist');
            Route::get('{id}/{status}/processs_view', [AllRequestMaterialController::class,'showRequestMaterial'])->name('request-new-material.processs_view');

            // Approve The Material by Clerk/HOD
            Route::post('{id}/{status}/receive', [AllRequestMaterialController::class,'receiveMaterial'])->name('request-new-material.receive');

            // Download new material request file
            Route::get('{id}/{status}/download', [AllRequestMaterialController::class,'download'])->name('request-new-material.download');
        });

        // =============== Replace  old materials with new ones
        Route::resource('replace-old-material',ReplaceOldMaterialController::class)
        ->names([
            'index'=>'replace-old-material.index',
            'create'=>'replace-old-material.create',
            'store'=>'replace-old-material.store',
            'show'=>'replace-old-material.show',
            'edit'=>'replace-old-material.edit',
            'update'=>'replace-old-material.update',
            'destroy'=>'replace-old-material.destroy'
        ]);

        // ======== fetch-order-details to show in select2 dropdown  in create replace form
        Route::post('fetch-orders-details', [ReplaceOldMaterialController::class,'fetchOrders'])->name('fetch_order_details');

        // === Handle  the return Material approval of request  from
        Route::prefix('replace-old-material')->group(function(){
            Route::get('list/{status}', [AllRequestReturnMaterialController::class,'index'])->name('replace-old-material.list');
            Route::get('{id}/{status}/view', [AllRequestReturnMaterialController::class,'show'])->name('replace-old-material.view');
            Route::get('{id}/{status}/approve', [AllRequestReturnMaterialController::class,'approveRequestMaterial'])->name('replace-old-material.approve');
            Route::post('{id}/{status}/reject', [AllRequestReturnMaterialController::class,'rejectRequestMaterial'])->name('replace-old-material.reject');
            Route::get('{status}/processs_list', [AllRequestReturnMaterialController::class,'listRequestMaterial'])->name('replace-old-material.processslist');
            Route::get('{id}/{status}/processs_view', [AllRequestReturnMaterialController::class,'showRequestMaterial'])->name('replace-old-material.processs_view');

            // Approve The Material by Clerk/HOD
            Route::post('{id}/{status}/receive', [AllRequestReturnMaterialController::class,'receiveMaterial'])->name('replace-old-material.receive');

            // Download new material request file
            Route::get('{id}/{status}/download', [AllRequestReturnMaterialController::class,'download'])->name('replace-old-material.download');
        });

});

