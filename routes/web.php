<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/vehicleDashboard', function () {
    return view('vue/vehicleDashboard');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['role:Administrator']], function () {
        Route::get('/brand', function () {
            return view('vue/brand');
        });
    
        Route::get('/fuel_type', function () {
            return view('vue/fuel_type');
        });
    
        Route::get('/vehicle_type', function () {
            return view('vue/vehicle_type');
        });
    
        Route::get('/accessory_type', function () {
            return view('vue/accessory_type');
        });
    
        Route::get('/departments', function () {
            return view('vue/department');
        });
    
        Route::get('/roles', function () {
            return view('vue/role');
        });
    
        Route::get('/municipalities', function () {
            return view('vue/municipality');
        });
    
        Route::get('/accessories', function () {
            return view('vue/accessory');
        });
    
        Route::get('/clients', function () {
            return view('vue/client');
        });
    
        Route::get('/users', function () {
            return view('vue/user');
        });
    });
    Route::group(['middleware' => ['role:Administrator|Adviser']], function () {
        Route::get('/rental_users', function () {
            return view('vue/rental_user');
        });
        Route::get('/rental', function () {
            return view('vue/rental');
        });
    });
    Route::group(['middleware' => ['role:Administrator|Adviser|Client']], function () {
        Route::get('/vehicle', function () {
            return view('vue/vehicle');
        });
    });
    
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
