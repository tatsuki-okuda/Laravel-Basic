<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePassController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Multipic;
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
    $brands = DB::table('brands')->get();
    $about = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'about', 'images'));
});

Route::get('/home', function () {
    echo 'this is Home Page';
});

Route::get('/about', function () {
    return view('about');
})->middleware('check');

Route::get('/contact', [ContactController::class, 'index'])->name('con');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();
    // return view('dashboard', compact('users'));

    return view('admin.index');
})->name('dashboard');
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');




// category controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/all', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::put('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/restore/{id}', [CategoryController::class, 'Pdelete']);


// Brand
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrnad'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);


// Multi Image
Route::get('/multi/image', [BrandController::class, 'MultiPic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImg'])->name('store.image');



// Admin All Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

// Admin Contact Page Route
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');

// Home Contact Page Route
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');


//Home About All Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::put('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);

// Portfolio Page Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');

// Change Password and User Profile Route
Route::get('/user/password', [ChangePassController::class, 'CPassword'])->name('change.password');
Route::post('/password/update', [ChangePassController::class, 'UpdatePassword'])->name('password.update');