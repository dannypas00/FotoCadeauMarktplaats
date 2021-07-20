<?php

use App\Http\Controllers\AdvertController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::middleware('auth:api')->group(
    function () {
        Route::get(
            '/user',
            function (Request $request) {
                return $request->user();
            }
        );

    }
);
Route::prefix('advert')->group(
    function () {
        Route::post('', [AdvertController::class, 'create']);
        Route::get('/list', [AdvertController::class, 'list']);
        Route::prefix('{advert}')->group(function () {
            Route::get('', [AdvertController::class, 'read']);
            Route::put('', [AdvertController::class, 'update']);
            Route::delete('', [AdvertController::class, 'delete']);
        });
   }
);
Route::get('/routes', function () {
    return new JsonResponse(Route::getRoutes(), 200);
});
