<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\SiteController;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\DepartementController;
use App\Http\Controllers\API\v1\DiagnosticController;
use App\Http\Controllers\API\v1\MaintenanceController;
use App\Http\Controllers\API\v1\AllPositionController;
use App\Http\Controllers\API\v1\PositionController;
use App\Http\Controllers\API\v1\StatusController;
use App\Http\Controllers\API\v1\VehicleController;
use App\Http\Controllers\API\v1\WorktimeController;
use App\Http\Controllers\API\v1\SendMailController;



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
    Route::post('reset-pass', 'resetPasswd');
    Route::post('forgot-pass', 'forgotPasswd');
    Route::get('send-mail', [SendMailController::class, 'testBody']);
    Route::get('send-mail/{token}', [SendMailController::class, 'testBody']);
    Route::post('send-mail', [SendMailController::class, 'index']);

});

// Route::prefix('v1/persons')
// Route::group(['prefix'=>'/v1', 'middleware' => ['auth:sanctum']], function () {
//     Route::apiResource("users", UserController::class);
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource("sites", SiteController::class);
    Route::apiResource("users", UserController::class);
    Route::apiResource("departements", DepartementController::class);
    Route::apiResource("diagnostics", DiagnosticController::class);
    Route::apiResource("maintenances", MaintenanceController::class);
    Route::apiResource("all-positions", AllPositionController::class);
    Route::apiResource("positions", PositionController::class);
    Route::apiResource("status", StatusController::class);
    Route::apiResource("vehicles", VehicleController::class);
    Route::apiResource("worktimes", WorktimeController::class);
});

Route::get('list', [UserController::class, 'index']);



Route::fallback(function (){
    abort(404, 'API resource not found');
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
