<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

// メール認証
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo 'this is Home Page';
});

Route::get('/about', function () {
    return view('about');
})->middleware('check');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('con');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');


// category controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])
    ->name('all.category');
Route::post('/category/all', [CategoryController::class, 'AddCat'])
    ->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::put('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/restore/{id}', [CategoryController::class, 'Pdelete']);


// Brand
Route::get('/brand/all', [BrandController::class, 'AllBrand'])
    ->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrnad'])
    ->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);


// Multi Image
Route::get('/multi/image', [BrandController::class, 'MultiPic'])
    ->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImg'])
    ->name('store.image');