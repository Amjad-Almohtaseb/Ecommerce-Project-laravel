<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontProductListController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// FrontProductListController
Route::get('/', [FrontProductListController::class, 'index']);
Route::get('/product/{id}', [FrontProductListController::class, 'show'])->name('product.view'); // change 'product.show' to 'product.view' because We used "product.show" in the product folder
Route::get('/store/{slug}', [FrontProductListController::class, 'allproduct'])->name('product.list');
// to search product
Route::get('/all/products', [FrontProductListController::class, 'moreProducts'])->name('more.product');

// CartController
Route::get('/addToCart/{product}', [CartController::class, 'addToCart'])->name('add.cart');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/products/{product}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/product/{product}', [CartController::class, 'removeCart'])->name('cart.remove');
//payment 
Route::get('/checkout/{amount}', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth'); // must login
Route::post('/charge', [CartController::class, 'charge'])->name('cart.charge');
Route::get('/orders', [CartController::class, 'order'])->name('order')->middleware('auth');
// END CartController

// UserController XX -> CategoryController
Route::get('/users-stores', [CategoryController::class, 'categoriesWithUser'])->name('getCategoriesWithUser');


/** Auth */
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
/** Auth */


Route::group(['prefix' => 'auth', 'middleware' => ['auth', 'isAdmin']], function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // add.admin
    Route::get('/add-admin', function () {
        return view('admin.add-admin-and-employee.add-admin');
    })->name('add.admin');
    Route::resource('store', CategoryController::class);
    // subcategory
    Route::get('section/store/{storeId}', [SubcategoryController::class, 'getSubcategoryByCatId'])->name('section.getSubcategoryByCatId');
    Route::resource('section', SubcategoryController::class);

    // product
    Route::get('product/section/{sectionId}', [ProductController::class, 'getProductBySubId'])->name('product.getProductBySubId');
    Route::resource('product', ProductController::class);

    Route::get('/orders', [CartController::class, 'userOrder'])->name('order.index');
    /*  ORDER */
    Route::get('/store-order', [CartController::class, 'storeOrder'])->name('order.store');
    Route::get('/orders/{orderid}', [CartController::class, 'viewUserOrder'])->name('user.order');  // {id} is user id
    Route::get('/store-order-item/{categoryId}', [CartController::class, 'viewStoreItem'])->name('item.order');   
    // Slider Admin
    Route::resource('slider', SliderController::class);

    /*  PROFILE ADMIN */
    Route::get('profile',[HomeController::class,'showUserProfile'])->name('profile');
    
});

// 
Route::get('sections/{id}', [ProductController::class, 'loadSubCategories']);



// Route::get('/index/test',[CategoryController::class, 'store']);
Route::get('/index/test', [ProductController::class, 'test']);
