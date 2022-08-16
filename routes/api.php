<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\LikesController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\ReminderController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\UserController;
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

////////////////////////////Begin:Api  public Routes............//////////////////////////////////////

Route::post('/login',[LoginController::class,'login']);
Route::post('signUp',[LoginController::class,'signUp']);
Route::post('forget',[LoginController::class,'forget']);
Route::post('reset',[LoginController::class,'reset']);
//////end: Public Routes............///////



////Begin: protected auth:sanctum Routes............///

Route::group(['middleware' => ['auth:sanctum','language']], function () {
    Route::get('users_list',[UserController::class,'index']);
    Route::post('/add-theme',[UserController::class,'addTheme']);
    Route::get('category_list',[CategoryController::class,'index']);
    Route::get('sub-category_list',[SubCategoryController::class,'index']);

////Begin:Api  quote Like Dislike Routes............///
    Route::post('/likes',[LikesController::class,'likes']);
    Route::post('/dis-likes',[LikesController::class,'dislikes']);
////end:Api  quote Like/Dislike Routes............///

/////Begin:Api  quote Favorite/Un favorite Routes............///
    Route::post('/favorite_quote',[FavoriteController::class,'favorite']);
    Route::post('/unfavorite_quote',[FavoriteController::class,'unfavorite']);

///Begin:Api  Quotes Routes............///
    Route::get('/quotes',[QuoteController::class,'index']);
    Route::post('/createQuote',[QuoteController::class,'createQuote']);
//end:Api  quote Favorite/Un favorite Routes............//////

/////Begin:Api  Collection Routes............///
    Route::get('/collection',[CollectionController::class,'collection']);
    Route::get('/collection-detail',[CollectionController::class,'collectionDetail']);
    Route::get('/collection-quotes',[CollectionController::class,'collectionQuotes']);
    Route::get('/collection-rating',[CollectionController::class,'getCollectionRating']);
    Route::post('/create-collection',[CollectionController::class,'createCollection']);
    Route::post('add-to-collection',[CollectionController::class,'addToCollection']);
    Route::post('/edit-collection',[CollectionController::class,'edit']);
    Route::post('/send-CollectionRating',[CollectionController::class,'sendCollectionRating']);
    Route::post('/delete-collection',[CollectionController::class,'destroy']);

        //end:Api  Collection  Routes............//////
        Route::post('/set-reminder',[ReminderController::class,'setReminder']);
});
///End: Protected auth:sanctum Routes............///
