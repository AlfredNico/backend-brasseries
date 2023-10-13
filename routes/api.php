<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('sign-in', 'signIn');
    Route::post('sign-up', 'signUp');
    Route::post('sign-out', 'signOut');
});

// Route::prefix('v1/persons')
// Route::group(['prefix'=>'/v1', 'middleware' => ['auth:sanctum']], function () {
//     Route::apiResource("users", UserController::class);
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource("users", UserController::class);
});

Route::get('list', [UserController::class, 'index']);

Route::fallback(function (){
    abort(404, 'API resource not found');
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
