<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;

// Route::get('api/signup',[ApiController::class,'register']);

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('location/state/add',[LocationController::class, 'addState'])->name('location.state.add');
Route::get('/apartment', [ApartmentController::class, 'apartment'])->name('apartment');
Route::get('apartment/apartmentAdd', [ApartmentController::class, 'apartmentadd'])->name('apartmentAdd');
Route::get('/customerLists', [CustomerController::class, 'index'])->name('index');





Route::group(['middleware' => 'auth'], function () {

	Route::get('/vendor', [VendorController::class, 'vendor_form'])->name('vendor');
    Route::post('/vendor/vendor-create', [VendorController::class, 'store'])->name('store');


	Route::get('location', [LocationController::class, 'location'])->name('location');
	Route::post('location/state/add',[LocationController::class, 'addState'])->name('location.state.add');
	Route::post('location/city/add',[LocationController::class, 'addCity'])->name('location.city.add');
	Route::post('location/area/add',[LocationController::class, 'addArea'])->name('location.area.add');

	Route::get('location/state/delete/{id}',[LocationController::class, 'deleteState'])->name('location.state.delete');
	Route::get('location/city/delete/{id}',[LocationController::class, 'deleteCity'])->name('location.city.delete');
	Route::get('location/area/delete/{id}',[LocationController::class, 'deleteArea'])->name('location.area.delete');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::get('/vendor',[ProfileController::class, 'vendor_form'])->name('vendor_form');
	Route::get('/vendor/vendor-list',[ProfileController::class, 'vendor_list'])->name('vendor_list');


});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

//apartment[ApartmentController::class, 'apartment']
// Route::post('signup', [ApiController::class, 'register']);


