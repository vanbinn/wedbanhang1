<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BannerController;

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
    return view('welcome');
});
Route::get('/hello', function () {
    return view('hello');
});


//trang chủ
Route::resource('products', PageController::class);
Route::get('/products/index/{id}', [PageController::class, 'index'])->name('product.index');
Route::get('/products/category/{id}', [PageController::class, 'category'])->name('product.category');
Route::get('/products/show/{id}', [PageController::class, 'show'])->name('product.show');
Route::post('/add-to-cart/{id}', [PageController::class, 'addToCart'])->name('add-to-cart');
Route::delete('/delete-item/{id}', [PageController::class, 'delCartItem'])->name('delete-item');
Route::post('/update-cart/{id}', [PageController::class, 'cartUpdate'])->name('update-cart');
Route::post('/add-many-to-cart/{id}', [PageController::class, 'addManyToCart'])->name('add-many-to-cart');
Route::get('/contacts', [PageController::class, 'contacts'])->name('product.contacts');
Route::get('/about', [PageController::class, 'about'])->name('product.about');

// Route quản lý sản phẩm
Route::get('sanpham', [PageController::class, 'getProList'])->name('getProList');
Route::get('them-sanpham', [PageController::class, 'getProAdd'])->name('product.getProAdd');
Route::post('them-sanpham', [PageController::class, 'postProAdd'])->name('product.postProAdd');
Route::get('xoa-sanpham/{id}', [PageController::class, 'getProDelete'])->name('product.getProDelete');
Route::post('xoa-sanpham/{id}', [PageController::class, 'getProDelete'])->name('product.getProDelete');
Route::get('sua-sanpham/{id}', [PageController::class, 'getProEdit'])->name('product.getProEdit');
Route::post('sua-sanpham/{id}', [PageController::class, 'postProEdit'])->name('product.postProEdit');

//Trang giỏ hàng
Route::get('/shopping_cart', [PageController::class, 'shopping_cart'])->name('product.shopping_cart');
Route::post('/shopping_cart', [PageController::class, 'postshopping_cart'])->name('postshopping_cart');

//Trang thanh toán
Route::get('/checkout', [PageController::class, 'checkout'])->name('product.checkout');
Route::post('/checkout',  [PageController::class, 'postCheckout'])->name('postCheckout');

//Trang đăng kí
Route::get('/signup',[PageController::class,'getSignin'])->name('getSignin');
Route::post('/signup',[PageController::class,'postSignin'])->name('postsignin');

//Trang đăng nhập
Route::get('/login',[UserController::class,'getLogin'])->name('getLogin');
Route::post('/login',[UserController::class,'postLogin'])->name('postLogin');
Route::get('/dangxuat',[UserController::class,'getLogout']);

// Route quản lí người dùng
Route::get('nguoidung', [UserController::class, 'getUserList'])->name('getUserList');
Route::get('them-nguoidung', [UserController::class, 'getUserAdd'])->name('product.getUserAdd');
Route::post('them-nguoidung', [UserController::class, 'postUserAdd'])->name('product.postUserAdd');
Route::post('xoa-nguoidung/{id}',[UserController::class, 'getUserDelete'])->name('product.getUserDelete');
Route::get('xoa-nguoidung/{id}', [UserController::class, 'getUserDelete'])->name('product.getUserDelete');
Route::get('sua-nguoidung/{id}', [UserController::class, 'getUserEdit'])->name('product.getUserEdit');
Route::post('sua-nguoidung/{id}', [UserController::class, 'postUserEdit'])->name('product.postUserEdit');

// Route quản lí banner
Route::get('banner', [BannerController::class, 'getBanList'])->name('getBanList');
Route::get('add-banner', [BannerController::class, 'getBanAdd'])->name('product.getBanAdd');
Route::post('add-banner', [BannerController::class, 'postBanAdd'])->name('product.postBanAdd');
Route::post('delete-banner/{id}',[BannerController::class, 'getBanDelete'])->name('product.getBanDelete');
Route::get('delete-banner/{id}', [BannerController::class, 'getBanDelete'])->name('product.getBanDelete');
Route::get('edit-banner/{id}', [BannerController::class, 'getBanEdit'])->name('product.getBanEdit');
Route::post('edit-banner/{id}', [BannerController::class, 'postBanEdit'])->name('product.postBanEdit');

Route::group(['prefix' => 'admin', 'middleware' => 'productsLogin'], function () {
   
    Route::group(['prefix'=>'category'],function(){
        // products/category/danhsach....................quản lí danh mục
        Route::get('danhsach', [CategoryController::class, 'getCateList'])->name('getCateList');
        // products/category/them
        Route::get('them',[CategoryController::class,'getCateAdd'])->name('product.getCateAdd');
        Route::post('them',[CategoryController::class,'postCateAdd'])->name('product.postCateAdd');
        Route::get('xoa/{id}',[CategoryController::class,'getCateDelete'])->name('product.getCateDelete');
        Route::get('sua/{id}',[CategoryController::class,'getCateEdit'])->name('product.getCateEdit');
        Route::post('sua/{id}',[CategoryController::class,'postCateEdit'])->name('product.postCateEdit');
    });
    Route::post('/categories', [CategoryController::class, 'postCateAdd'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'getCateEdit'])->name('categories.getCateEdit');
    Route::post('/products/category/{id}/edit', [CategoryController::class, 'postCateEdit'])->name('categories.postCateEdit');
    Route::post('/products/category/xoa/{id}', [CategoryController::class, 'getCateDelete'])->name('categories.getCateDelete');



 

    //viết tiếp các route khác cho crud products, users,.... thì viết tiếp

    Route::group(['prefix'=>'bill'],function(){
        // products/bill/{status}
        Route::get('{status}',[BillController::class,'getBillList'])->name('products.getBillList');
        //phần bill này không nhất thiết phải dùng request ajax, làm như những hàm bình thường, phần route này cô vẫn để lại để tham khảo
        //by laravel request
        Route::get('{id}/{status}',[BillController::class,'updateBillStatus'])->name('products.updateBillStatus');
        //by ajax request
        Route::post('updateBillStatusAjax',[BillController::class,'updateBillStatusAjax'])->name('products.updateBillStatusAjax');
       
        Route::post('{id}',[BillController::class,'cancelBill'])->name('products.cancelBill');
    });

});