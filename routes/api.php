<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CoursierController;
use App\Http\Controllers\MarchandController;
use App\Http\Controllers\ProduitController;

use App\Models\Produit;

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


  

   

    // Route::resource('/produits', ProduitController::class);
    
    // public route
    //------------------//
    // All get

    /*
    Route::get('/clients',[ClientController::class,'index']);
    Route::get('/commands',[CommandeController::class,'index']);
    Route::get('/produits',[ProduitController::class,'index']);
    Route::get('/coursiers',[CoursierController::class,'index']);
    Route::get('/marchands',[MarchandController::class,'index']);
    */

    Route::get('/produits/search/{produit}',[ProduitController::class,'search']);
    Route::group(['middleware' => ['auth:sanctum']], function(){

    // Protected route//
    //------------------//

    // All Post

    Route::post('/clients',[ClientController::class,'store']);
    Route::post('/commands',[CommandeController::class,'store']);
    Route::post('/produits',[ProduitController::class,'store']);
    Route::post('/coursiers',[CoursierController::class,'store']);
    Route::post('/marchands',[MarchandController::class,'store']);
    
    // All Update

    Route::put('/clients/{client}',[ClientController::class,'update']);
    Route::put('/commands/{command}',[CommandeController::class,'update']);
    Route::put('/produits/{produit}',[ProduitController::class,'update']);
    Route::put('/coursiers/{coursier}',[CoursierController::class,'update']);
    Route::put('/marchands/{marchand}',[MarchandController::class,'update']);

    // All Delete

    Route::delete('/clients/{client}',[ClientController::class,'destroy']);
    Route::delete('/commands/{command}',[CommandeController::class,'destroy']);
    Route::delete('/produits/{produit}',[ProduitController::class,'destroy']);
    Route::delete('/coursiers/{coursier}',[CoursierController::class,'destroy']);
    Route::delete('/marchands/{marchand}',[MarchandController::class,'destroy']);


    });


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
    });
