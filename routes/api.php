<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleDetailController;
use App\Http\Controllers\VehicleTypeController;
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

Route::get('/brands', [BrandController::class, 'index']);

Route::prefix('/brand')->group(
    function () {
        Route::post('/store', [BrandController::class, 'store']);
        Route::put('/{id}', [BrandController::class, 'update']);
        Route::delete('/{id}', [BrandController::class, 'destroy']);
        Route::get('/listar', [BrandController::class, 'listar']);
    }
);

Route::get('/fuel_types', [FuelTypeController::class, 'index']);

Route::prefix('/fuel_type')->group(
    function () {
        Route::post('/store', [FuelTypeController::class, 'store']);
        Route::put('/{id}', [FuelTypeController::class, 'update']);
        Route::delete('/{id}', [FuelTypeController::class, 'destroy']);
    }
);

Route::get('/vehicle_types', [VehicleTypeController::class, 'index']);

Route::prefix('/vehicle_type')->group(
    function () {
        Route::post('/store', [VehicleTypeController::class, 'store']);
        Route::put('/{id}', [VehicleTypeController::class, 'update']);
        Route::delete('/{id}', [VehicleTypeController::class, 'destroy']);
    }
);



Route::get('/vehicles', [VehicleController::class, 'index']);

Route::prefix('/vehicle')->group(
    function () {
        Route::post('/store', [VehicleController::class, 'store']);
        Route::put('/{id}', [VehicleController::class, 'update']);
        Route::delete('/{id}', [VehicleController::class, 'destroy']);
        Route::get('/dashboardVehicle', [VehicleController::class, 'dashboardVehicle']);
        //Route::get('/listar', [BrandController::class, 'listar']);
    }
);

Route::get('/galeries', [GaleryController::class, 'index']);

Route::prefix('/galery')->group(
    function () {
        Route::get('/list/{id}', [GaleryController::class, 'list']);
        Route::post('/store', [GaleryController::class, 'store']);
        Route::delete('/{id}', [GaleryController::class, 'destroy']);
    }
);

//Route::get('/galeries', [GaleryController::class, 'index']);

Route::prefix('/vehicle_detail')->group(
    function () {
        Route::post('/store', [VehicleDetailController::class, 'store']);
        Route::get('/list/{id}', [VehicleDetailController::class, 'list']);
        Route::put('/updateVehicleDetail', [VehicleDetailController::class, 'updateVehicleDetail']);
        Route::post('/createDefaultDetailVehicle/{id}', [VehicleDetailController::class, 'createDefaultDetailVehicle']);
        //Route::delete('/{id}', [GaleryController::class, 'destroy']);
        Route::get('/listAccessoriesUnAssigned/{id}', [VehicleDetailController::class, 'listAccessoriesUnAssigned']);

        
    }
);