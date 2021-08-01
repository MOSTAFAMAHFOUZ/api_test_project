<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CategoriesController;

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

Route::get('all-categories',[CategoriesController::class,'allCategories']);
Route::get('categories',[CategoriesController::class,'index']);
Route::get('categories/{category}',[CategoriesController::class,'show']);


Route::middleware('api_auth')->group(function(){
    Route::get('getData',function(){
        return response()->json(['ok'],200);
    });

    
    Route::apiResource('products',ProductsController::class)->except(['edit','update','create','destroy']);
    // logout
    Route::post('user-logout',[UsersController::class,'logout']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('user-register',[UsersController::class,'register']);
Route::post('user-login',[UsersController::class,'login']);
