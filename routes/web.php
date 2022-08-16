<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\UserController;
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
    return view('login');
});

//.............Login Section //Public Routes............../////////////
Route::get('/login',[AdminController::class,'login'])->name('login');
Route::post('verify_login',[AdminController::class,'create'])->name('verify_login');
/////////////////////////........Register Section......///////////////////
Route::get('register',[AdminController::class,'register'])->name('register');
Route::post('sign_up',[AdminController::class,'store'])->name('sign_up');
/////////////////////////........Forget Section......///////////////////
Route::get('forget_password',[AdminController::class,'forgetPassword'])->name('forget');
Route::post('submit_forget',[AdminController::class,'Forget'])->name('submit_forget');

/////////////////////////........Reset Password Section......///////////////////
Route::get('reset_password',[AdminController::class,'resetPassword'])->name('reset_password');
Route::post('submit_reset',[AdminController::class,'postReset'])->name('submit_reset');


//..............Protected Routes............///////////////
Route::group(['middleware' => 'auth'], function () {
    Route::get('star',[AdminController::class,'star']);
    Route::get('dashboard',[UserController::class,'index'])->name('dashboard');
    /////////////////////////........Users  Section......///////////////////
    Route::get('/users',[UserController::class,'user'])->name('users');
    Route::get('/users_list',[UserController::class,'usersList'])->name('usersList');
    Route::get('change_status/{id}', [UserController::class,'changeStatus'])->name('changeStatus');
    /////////////////////////........Users Theme  Section......///////////////////
    Route::get('/themes',[UserController::class,'theme'])->name('themes');

    //////////////////////////.......Category Section .........../////////
    Route::get('categories',[CategoriesController::class,'index'])->name('categories');
    Route::get('edit/category/{id}', [CategoriesController::class,'editCategory'])->name('edit/category');
    Route::get('delete_Category/{id}',[CategoriesController::class,'destroy'])->name('delete');
    Route::post('add_categories',[CategoriesController::class,'store'])->name('add_categories');
    Route::post('update_categories',[CategoriesController::class,'update'])->name('update_categories');

    //////////////////////////.......Category Section .........../////////
    Route::get('sub_categories',[SubCategoriesController::class,'index'])->name('sub_categories');
    Route::get('edit/sub-category/{id}', [SubCategoriesController::class,'edit'])->name('edit/sub-category');
    Route::get('delete_sub-category/{id}',[SubCategoriesController::class,'destroy'])->name('delete');
    Route::post('add_sub-categories',[SubCategoriesController::class,'store'])->name('add_sub-categories');
    Route::post('update_sub-categories',[SubCategoriesController::class,'update'])->name('update_sub-categories');

    //////////////////////////.......Quotes Section .........../////////
    Route::get('quotes',[QuotesController::class,'index'])->name('quotes');
    //////////////////////////.......collections Section .........../////////
    Route::get('/collections',[CollectionController::class,'index'])->name('collections');
    Route::get('/collection_list',[CollectionController::class,'collectionList'])->name('collection-list');
    Route::get('change_collection-type/{id}', [CollectionController::class,'changeCollectionType'])->name('changeCollectionType');



});



Route::get('/test',[CollectionController::class,'index']);
///////////////////................LogOut Route Section............./////////////
Route::post('/logout',[AdminController::class,'logout'])->name('logout');
