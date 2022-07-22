<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | is assigned the "api" middleware group. Enjoy building your API!
// |
// */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

/* Ex. localhost/<project_name>/public/api/v1 */
Route::prefix('v1')->group(function () {

    /*  Autthenticate routes
        Ex. api/v1/register 
        Route::post('__ชื่อpath api__', [___ชื่อ controller___::class, '__function ใน controller__']);
        tip!!! พิมพ์ชื่อ controller บางส่วนแล้ว enter ตัว use จะมาเอง
    */
    Route::post('register', [AuthController::class, 'register']);
    /* Ex. api/v1/login */
    Route::post('login', [AuthController::class, 'login']);
    /* Ex. api/v1/logout */
    Route::post('logout', [AuthController::class, 'logout']);

    /**
     * User routes
     */
    /* Ex. api/v1/user/profile */
    Route::get('user/profile', [UserController::class, 'getProfile']);
    /* Ex. api/v1/user/2 */
    Route::put('user/{user}', [UserController::class, 'updateProfile']);

    /**
     * Category routes
     * สร้าง Route ให้ใช้ CRUD ใน controller ได้เลย
     */
    Route::apiResource('/categories', CategoryController::class);

    /**
     * Cart routes
     * สร้าง Route ให้ใช้ CRUD ใน controller ได้เลย
     */
    Route::apiResource('/carts', CartController::class);


});