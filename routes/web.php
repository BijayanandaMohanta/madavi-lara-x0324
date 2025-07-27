<?php

use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
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

//Frontend routes
Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/about", [HomeController::class, "about"])->name("about");
Route::get("/products", [HomeController::class, "products"])->name("products");
Route::get("/product", [HomeController::class, "product"])->name("product");
Route::get("/menu", [HomeController::class, "menu"])->name("menu");
Route::get("/contact", [HomeController::class, "contact"])->name("contact");
Route::any("/invoice/{sid}", [CartController::class, "invoice"])->name("invoice");

//Backend routes/Admin routes
Auth::routes();

Route::group(['middleware' => ['isAdmin', 'auth']], function () {
    Route::get('admin', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
    Route::get('admin/profile', [\App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('admin_profile');
    Route::put('admin/profile', [\App\Http\Controllers\Admin\AdminController::class, 'updateAdminProfile'])->name('update_admin_profile');
    Route::get('logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('logout');

    Route::get('/database-export-backup', function () {
        return view('admin.settings.db_backup'); // Replace 'export.database' with your view name
    })->name('database-export-backup');

    Route::get('/export-database', '\App\Http\Controllers\Admin\AdminController@exportDatabase')->name('export-database');



    Route::resource('admin/site-settings', '\App\Http\Controllers\Admin\SettingsController');
    Route::resource('admin/social-media-settings', '\App\Http\Controllers\Admin\SocialMediaSettingsController');
    Route::resource('admin/seo-settings', '\App\Http\Controllers\Admin\SeoSettingsController');

    Route::resource('admin/brands', '\App\Http\Controllers\Admin\BrandsController');

    Route::resource('admin/categories', '\App\Http\Controllers\Admin\CategoriesController');
    Route::resource('admin/scategories', '\App\Http\Controllers\Admin\ScategoryController');
    Route::resource('admin/ccategories', '\App\Http\Controllers\Admin\CcategoryController');
    Route::any('/fetchscategory', [\App\Http\Controllers\Admin\CcategoryController::class, 'fetchscategory'])->name('fetchscategory');
    Route::resource('admin/tele_orders', '\App\Http\Controllers\Admin\TeleorderController');

    Route::any('/get-product-price', [\App\Http\Controllers\Admin\TeleorderController::class, 'getProductPrice'])->name('get_product_price');


    Route::resource('admin/pages', '\App\Http\Controllers\Admin\PagesController');
    Route::resource('admin/banners', '\App\Http\Controllers\Admin\BannersController');
    Route::resource('admin/ads', '\App\Http\Controllers\Admin\AdsController');
    Route::resource('admin/notification', '\App\Http\Controllers\Admin\NotificationController');
    // 2024-09-10T12:15:08.000-05:00
    Route::resource('admin/product', '\App\Http\Controllers\Admin\ProductController');
    Route::resource('admin/faq', '\App\Http\Controllers\Admin\FaqController');

    // Product price and mop update
    Route::any('admin/product_price_update', '\App\Http\Controllers\Admin\ProductController@product_price_update')->name('product_price_update');
    Route::any('admin/product_mop_update', '\App\Http\Controllers\Admin\ProductController@product_mop_update')->name('product_mop_update');

    Route::any('/fetchccategory', [\App\Http\Controllers\Admin\ProductController::class, 'fetchccategory'])->name('fetchccategory');

    Route::resource('admin/product_image', '\App\Http\Controllers\Admin\ProductImageController');
    Route::resource('admin/faq_image', '\App\Http\Controllers\Admin\FaqImageController');
    Route::delete('admin/product-images/{id}', 'ProductImageController@destroy')->name('product-images.destroy');
    Route::resource('admin/product_stock', '\App\Http\Controllers\Admin\ProductStockController');


    // 2024-09-16T11:02:46.000-05:00
    Route::resource('admin/videoreviews', '\App\Http\Controllers\Admin\VideoReviewsController');
    Route::resource('admin/testimonial', '\App\Http\Controllers\Admin\TestimonialController');

    Route::resource('admin/store_gallery', '\App\Http\Controllers\Admin\StoreGalleryController');

    // 2024-09-18T15:46:07.000-05:00
    Route::resource('admin/tags', '\App\Http\Controllers\Admin\TagsController');

    // 2024-09-20T12:30:23.000-05:00
    Route::any('admin/categories/ad_index/{id}', '\App\Http\Controllers\Admin\CategoriesController@ad_index')->name('categories.ad_index');
    Route::any('admin/categories/ad_edit/{id}', '\App\Http\Controllers\Admin\CategoriesController@ad_edit')->name('categories.ad_edit');
    Route::any('admin/categories/ad_store', '\App\Http\Controllers\Admin\CategoriesController@ad_store')->name('categories.ad_store');
    Route::any('admin/categories/ad_update/{id}', '\App\Http\Controllers\Admin\CategoriesController@ad_update')->name('categories.ad_update');
    Route::any('admin/categories/ad_destroy/{id}', '\App\Http\Controllers\Admin\CategoriesController@ad_destroy')->name('categories.ad_destroy');

    Route::any('admin/product_image_priority', '\App\Http\Controllers\Admin\ProductImageController@product_image_priority')->name('product_image_priority');

    Route::resource('admin/orders', '\App\Http\Controllers\Admin\OrdersController');
    // update with ajax
    Route::post('admin/orders_update_ajax', '\App\Http\Controllers\Admin\OrdersController@orders_update_ajax')->name('orders_update_ajax');
    Route::get('admin/place-orders', '\App\Http\Controllers\Admin\OrdersController@place_orders')->name('place_orders');

    Route::any('admin/shipment/{sid}', '\App\Http\Controllers\Admin\ShipmentController@shipment_in')->name('shipment');
    Route::any('admin/shipment_generate', '\App\Http\Controllers\Admin\ShipmentController@shipment_generate')->name('shipment_generate');


    Route::get('admin/products/duplicate/{id}', '\App\Http\Controllers\Admin\ProductController@duplicate')->name('product.duplicate');
    Route::any('products/duplicate/{id}', '\App\Http\Controllers\Admin\ProductController@duplicate_store')->name('product.duplicate_store');
    Route::any('products/delete-file', '\App\Http\Controllers\Admin\ProductController@deleteFile')->name('delete-file');

    // 2024-10-14T14:32:10.000-05:00
    Route::resource('admin/coupon', '\App\Http\Controllers\Admin\CouponController');
    Route::resource('admin/notify', '\App\Http\Controllers\Admin\NotifyController');
    Route::resource('admin/newsletter', '\App\Http\Controllers\Admin\NewsletterController');

    // Subadmin format
    Route::resource('admin/users', '\App\Http\Controllers\Admin\UserController');

    // Registered user display
    Route::any('admin/registeredusers', '\App\Http\Controllers\Admin\UserController@registeredusers')->name('registeredusers');
    Route::any('admin/deleteregisteredusers/{id}', '\App\Http\Controllers\Admin\UserController@deleteregisteredusers')->name('deleteregisteredusers');

    // Seller
    Route::any('admin/registeredsellers', '\App\Http\Controllers\Admin\SellerController@registeredsellers')->name('registeredsellers');
    Route::any('admin/deleteregisteredsellers/{id}', '\App\Http\Controllers\Admin\SellerController@deleteregisteredsellers')->name('deleteregisteredsellers');
    Route::any('admin/update_seller_status', '\App\Http\Controllers\Admin\SellerController@update_seller_status')->name('update_seller_status');
    
    Route::resource('admin/roles', '\App\Http\Controllers\Admin\RoleController');
    Route::any('admin/report/orders_report', '\App\Http\Controllers\Admin\ReportController@orders_report')->name('order_report');
    Route::any('admin/report/stocks_report', '\App\Http\Controllers\Admin\ReportController@stocks_report')->name('stocks_report');
    Route::any('admin/report/best_selling_products_report', '\App\Http\Controllers\Admin\ReportController@best_selling_products_report')->name('best_selling_products_report');
    Route::any('admin/report/statistics_report', '\App\Http\Controllers\Admin\ReportController@statistics_report')->name('statistics_report');

    // Export report
    Route::any('admin/export_stock_report', '\App\Http\Controllers\Admin\ReportController@export_stock_report')->name('export_stock_report');
    Route::any('admin/export_best_selling_products_report', '\App\Http\Controllers\Admin\ReportController@export_best_selling_products_report')->name('export_best_selling_products_report');
    Route::any('admin/export_contact_enquiry', '\App\Http\Controllers\Admin\ReportController@export_contact_enquiry')->name('export_contact_enquiry');

    //25 nov export_contact_enquiry
    Route::resource('admin/productreviews', '\App\Http\Controllers\Admin\ProductReviewController');

    Route::any('admin/contactrequest', '\App\Http\Controllers\Admin\AdminController@contactrequest')->name('contactrequest');
    Route::delete('admin/contactdelete/{id}', '\App\Http\Controllers\Admin\AdminController@contactdelete')->name('contactdelete');


    Route::any('admin/update_review_status', '\App\Http\Controllers\Admin\ProductReviewController@update_review_status')->name('update_review_status');
    Route::any('admin/update_review_status_home', '\App\Http\Controllers\Admin\ProductReviewController@update_review_status_home')->name('update_review_status_home');

    // Export product_export
    Route::any('admin/product_export', '\App\Http\Controllers\Admin\ProductController@product_export')->name('product_export');
    Route::any('admin/product_export_all', '\App\Http\Controllers\Admin\ProductController@product_export_all')->name('product_export_all');

    //
    Route::post('/product_data_update', '\App\Http\Controllers\Admin\ProductController@product_data_update')->name('product_data_update');
    Route::resource('admin/reward_coupons', '\App\Http\Controllers\Admin\RewardCouponController');

    Route::any('admin/newsletter_export', '\App\Http\Controllers\Admin\NewsletterController@newsletter_export')->name('newsletter_export');

    Route::any('admin/export_reg_user', '\App\Http\Controllers\Admin\UserController@export_reg_user')->name('export_reg_user');

    Route::post('/export-orders', '\App\Http\Controllers\Admin\ReportController@exportOrders')->name('export.orders');

    Route::post('/update_order_sl_no', [\App\Http\Controllers\Admin\OrdersController::class, 'update_order_sl_no'])
    ->name('update_order_sl_no');

    // Export cart
    Route::any('admin/export_all_pending_cart', '\App\Http\Controllers\Admin\ReportController@export_all_pending_cart')->name('export_all_pending_cart');

});

// Generate invoice
Route::get('/invoice-generate/{sid}', [\App\Http\Controllers\Admin\OrdersController::class, 'invoiceGenerate'])
    ->name('invoice-generate');

Route::get('/download-all-invoice', [\App\Http\Controllers\Admin\OrdersController::class, 'download_all_invoice'])
    ->name('download-all-invoice');

Route::get('/download-all-invoice-report', [\App\Http\Controllers\Admin\ReportController::class, 'download_all_invoice_report'])
    ->name('download-all-invoice-report');


// Developer Route for Testing
Route::get('/devtest', [\App\Http\Controllers\Frontend\TestingController::class,'index'])->name('devtest');
