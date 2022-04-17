<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

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



// Front-end
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::post('/tim-kiem', [HomeController::class, 'search']);

//Danh mục sp
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'show_brand']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'details_product']);


//back-end

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/dashboard', [AdminController::class, 'show_dashboard']);

Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

Route::get('/logout', [AdminController::class, 'log_out']);

//Category Product

Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);
Route::get('/edit-category-product/{category_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_id}', [CategoryProduct::class, 'delete_category_product']);

Route::get('/unactive-category-product/{category_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_id}', [CategoryProduct::class, 'active_category_product']);

Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::post('/update-category-product/{category_id}', [CategoryProduct::class, 'update_category_product']);

// Brand Product

Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);
Route::get('/edit-brand-product/{brand_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_id}', [BrandProduct::class, 'delete_brand_product']);

Route::get('/unactive-brand-product/{brand_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_id}', [BrandProduct::class, 'active_brand_product']);

Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
Route::post('/update-brand-product/{brand_id}', [BrandProduct::class, 'update_brand_product']);

//Product

Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

//Coupon
Route::post('/check-coupon', [CartController::class, 'check_coupon']);

Route::get('/add-coupon', [CouponController::class, 'add_coupon']);
Route::get('/all-coupon', [CouponController::class, 'all_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);

Route::post('/save-coupon', [CouponController::class, 'save_coupon']);



//Cart

Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/gio-hang', [CartController::class, 'gio_hang']);
Route::get('/delete-product-cart/{session_id}', [CartController::class, 'delete_pd_cart']);
Route::get('/del-all', [CartController::class, 'del_all_pd_cart']);


//CheckOut

Route::get('/checkout', [CheckoutController::class, 'show_checkout']);
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::get('/logout-customer', [CheckoutController::class, 'logout_customer']);
Route::post('/save-checkout-customer/{customer_id}', [CheckoutController::class, 'save_checkout_customer']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home']);
Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee']);

//Order

Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{order_id}', [OrderController::class, 'view_order']);
Route::get('/delete-order/{order_id}', [OrderController::class, 'delete_order']);
Route::post('/update-order-product-qty', [OrderController::class, 'update_order_product_qty']);
Route::post('/update-pd-qty-order', [OrderController::class, 'update_pd_qty_order']);
Route::get('/ordered/{customer_id}', [OrderController::class, 'ordered']);



//Delivery

Route::get('/delivery', [DeliveryController::class, 'delivery']);
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery']);
Route::post('/insert-delivery', [DeliveryController::class, 'insert_delivery']);
Route::get('/update-delivery', [DeliveryController::class, 'update_delivery']);
Route::post('/select-feeship', [DeliveryController::class, 'select_feeship']);






