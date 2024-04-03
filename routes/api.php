<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/user/signup', [UserController::class, 'signup']);
Route::post('/user/logins', [UserController::class, 'login']);
Route::get('/locations/get_countries', [UserController::class, 'get_countries']);
Route::post('/locations/get_states', [UserController::class, 'get_states']);
Route::post('/locations/get_cities', [UserController::class, 'get_cities'])->name('get_cities');
Route::post('/locations/get_areas', [UserController::class, 'get_areas']);
Route::post('/locations/get_apartments', [UserController::class, 'get_apartments']);
Route::post('/customer/store', [UserController::class, 'store']);
Route::post('/get_apartments_insert', [UserController::class, 'get_apartments_insert'])->name('get_apartments_insert');
Route::post('/user/search', [UserController::class, 'search']);
Route::post('/user/uploadprofileimg',[UserController::class,'uploadprofileimg']);
Route::post('/user/otp_send',[UserController::class,'otp_send']);
Route::post('/user/otpverfication',[UserController::class,'otpverfication']);
Route::post('/user/singlesignup', [UserController::class, 'singlesignup']);





















