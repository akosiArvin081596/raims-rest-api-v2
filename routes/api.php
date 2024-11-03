<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RegistrationController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\LguDashboardController;
use App\Http\Controllers\API\LguAssistanceRequestController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Admin\LguRegistrationController;
use App\Http\Controllers\API\Admin\SocialWorkerRegistrationController;
use App\Http\Controllers\API\Admin\SocialWorkerAssignmentController;
use App\Http\Controllers\API\Admin\LguUsersAssignmentController;
use App\Http\Controllers\API\SocialWorkerDashboardController;
use App\Http\Controllers\API\DeliveryController;
use App\Http\Middleware\CheckUserRole;

/*
|--------------------------------------------------------------------------
| Public Routes - these routes are accessible without authentication.
|--------------------------------------------------------------------------
*/

// Registration and login routes
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register-test-admin', [RegistrationController::class, 'registerTestAdminUser']);
});

/*      
|--------------------------------------------------------------------------
| Protected Routes (Authenticated Routes) - these routes require the user to be authenticated with a Sanctum token.
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // User Routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/users', [UserController::class, 'index']);

    // Logout Route
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | Role-Specific Routes - These routes require both authentication and a specific user role.
    |--------------------------------------------------------------------------
    */
    
    Route::prefix('social-worker')->middleware(CheckUserRole::class . ':social-worker')->group(function () {
        Route::get('/dashboard', [SocialWorkerDashboardController::class, 'index']);
    });
    /*
    |--------------------------------------------------------------------------
    | LGU-Specific Routes (With /lgu Prefix)
    |--------------------------------------------------------------------------
    */
    Route::prefix('lgu')->middleware(CheckUserRole::class . ':lgu-user')->group(function () {
        Route::get('/dashboard', [LguDashboardController::class, 'index']);
        
        Route::post('/request-assistance', [LguAssistanceRequestController::class, 'store']);
    });

    /*
    |--------------------------------------------------------------------------
    | Admin-Specific Routes (With /lgu Prefix)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(CheckUserRole::class . ':admin')->group(function () {
        Route::post('/register-admin-user', [RegistrationController::class, 'registerAdminUser']);

        Route::post('/register-lgu-user', [RegistrationController::class, 'registerLguUser']);

        Route::post('/add-new-lgu', [AdminController::class, 'addNewLgu']);

        Route::post('/register-social-worker', [RegistrationController::class, 'registerSocialWorker']);

        Route::post('/register-delivery-user', [RegistrationController::class, 'registerDeliveryUser']);

        Route::post('/assign-social-worker-to-lgu', [SocialWorkerAssignmentController::class, 'assignSocialWorkerToLgu']);

        Route::post('/assign-lgu-user-to-lgu', [LguUsersAssignmentController::class, 'assignLguUserToLgu']);

        Route::post('/assign-item-to-delivery-user/{id}', [DeliveryController::class, 'assignToDeliveryUser']);
    });

    // Delivery Routes
    Route::prefix('delivery-user')->middleware(CheckUserRole::class . ':delivery-user')->group(function () {
        Route::get('/assigned-items', [DeliveryController::class, 'getAssignedItems']); // Fetch items
        
        Route::put('/update-item-status/{id}', [DeliveryController::class, 'updateStatus']);   
    });
});
