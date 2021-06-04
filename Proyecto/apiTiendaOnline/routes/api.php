<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\classificationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliverytypeController;
use App\Http\Controllers\VehicletypeController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\DriversController;
//AGREGAR REFERENCIAS DE CONTROLADOR
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

//http: //127.0.0.1:8000/api/v1/SmartStore/
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'SmartStore'], function () {
        //Rutas auth
        Route::group([
            'prefix' => 'auth'
        ], function ($router) {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('register', [AuthController::class, 'register']);
            Route::post('logout', [AuthController::class, 'logout']);
        });


        Route::group(
            ['prefix' => 'rol'],
            function ($router) {
                Route::get('', [RolController::class, 'index']);
            }
        );

        Route::group(
            ['prefix' => 'category'],
            function ($router) {
                Route::get('', [CategoriesController::class, 'index']);
            }
        );


        Route::group(
            ['prefix' => 'classification'],
            function ($router) {
                Route::get('', [classificationController::class, 'index']);
            }
        );

        Route::group(
            ['prefix' => 'delivery'],
            function ($router) {
                Route::get('', [DeliverytypeController::class, 'index']);
            }
        );

        Route::group(
            ['prefix' => 'vehicletype'],
            function ($router) {
                Route::get('', [VehicletypeController::class, 'index']);
            }
        );

        Route::group(
            ['prefix' => 'transport'],
            function ($router) {
                Route::get('', [TransportController::class, 'index']);
            }
        );

        Route::group(
            ['prefix' => 'driver'],
            function ($router) {
                Route::get('', [DriversController::class, 'index'])->middleware(['auth:api', 'scopes:vendedor']);
                Route::post('', [DriversController::class, 'store'])->middleware(['auth:api', 'scopes:administrador']);
                Route::patch('/{id}', [DriversController::class, 'update'])->middleware(['auth:api', 'scopes:administrador']);
                Route::post('updateState', [DriversController::class, 'updateState'])->middleware(['auth:api', 'scopes:administrador']);
                Route::get('all', [DriversController::class, 'all'])->middleware(['auth:api', 'scopes:administrador']);
                Route::get('/{id}', [DriversController::class, 'show']);
            }
        );

        Route::group([
            'prefix' => 'order'
        ], function ($router) {
            Route::get('', [OrderController::class, 'index'])->middleware(['auth:api', 'scopes:vendedor']);
            //Route::get('all', [OrderController::class, 'all'])->middleware(['auth:api', 'scopes:administrador']);
            Route::post('', [OrderController::class, 'store'])->middleware(['auth:api', 'scopes:cliente']);
            Route::get('/{id}', [OrderController::class, 'show']);
        });

        Route::group([
            'prefix' => 'bill'
        ], function ($router) {
            Route::get('', [BillsController::class, 'index']);
            Route::post('create', [BillsController::class, 'store'])->middleware(['auth:api', 'scopes:vendedor']);
            Route::post('update', [BillsController::class, 'update'])->middleware(['auth:api', 'scopes:vendedor']);
        });

        Route::group([
            'prefix' => 'product'
        ], function ($router) {
            Route::get(
                'all',
                [ProductsController::class, 'all']
            )->middleware(['auth:api', 'scopes:administrador']);
            Route::get('', [ProductsController::class, 'index']);
            Route::post('create', [ProductsController::class, 'store'])->middleware(['auth:api']);
            Route::patch('update/{id}', [ProductsController::class, 'update'])->middleware(['auth:api']);
            Route::get('/{id}', [ProductsController::class, 'show']);
        });
    });
});
