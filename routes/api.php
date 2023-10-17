<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PublicController;
use App\Http\Controllers\API\RelawanController as RelawanApi;
use App\Http\Controllers\API\SaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);

//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//API Route for public

    Route::get('regencies_prov_id',[PublicController::class,'getRegenciesByProvinceId']);
Route::group(['prefix'=>'public'],function (){ 
    Route::get('regencies',[PublicController::class,'getRegencies']);
    Route::get('get-district',[PublicController::class,'getDistrictByRegencyId']);
    Route::get('get-village',[PublicController::class,'getVillageByDistrictId']);
    Route::get('get-fraud',[PublicController::class,'getFraud']);
    Route::middleware(['check-token'])->group(function ()
    {
        Route::get('get-tps',[PublicController::class,'getTPS']);
        Route::get('get-tps-masuk',[PublicController::class,'getTPSMasuk']);
        Route::get('get-tps-kosong',[PublicController::class,'getTPSKosong']);
        Route::get('get-voice',[PublicController::class,'getSuara']);
        Route::post('register-saksi-pusat',[AuthController::class,'registerPusat']);
        Route::get('get-tps-by-village-id',[PublicController::class,'tpsByVillage']);
    });
});


//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function () {
        return response()->json(auth()->user(), 200);
    });
    Route::group(['middleware' => "apirole:saksi", 'prefix' => "saksi"], function () {
        Route::post('/upload-c1-plano', [SaksiController::class, 'uploadC1Plano']);
    });
    Route::group(['middleware' => "apirole:relawan", 'prefix' => "relawan"], function () {
        Route::post('/upload-c1-relawan', [RelawanApi::class, 'uploadC1Relawan']);
    });
    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});
