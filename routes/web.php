<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CmsController;
use App\Http\Controllers\Frontend\SellerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\OtpController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\CartController;
// Rozer pay
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\Cron\UpdateOrderStatusController;
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

// Route to call the index function of UpdateOrderStatusController
// Cron jobs

Route::get('/cron/update-order-status', [UpdateOrderStatusController::class, 'update_order_status'])->name('cron.update_order_status');
Route::get('/cron/check-pending-payments', [UpdateOrderStatusController::class, 'check_pending_payments'])->name('check_pending_payments');
Route::get('/cron/wp-message-queue', [RazorpayController::class, 'wpQueueCron'])->name('wp_message_queue');


// Rozer pay


// Route::get('/razorpay-initiate', [RazorpayController::class, 'initiatePayment'])->name('razorpay.initiate');
Route::any('/razorpay-callback', [RazorpayController::class, 'handleCallback'])->name('razorpay.callback');

//Frontend routes
Route::get("/", [HomeController::class, "index"])->name("home");

// CMS
Route::get("/terms-of-service", [CmsController::class, "termsofservice"])->name("termsofservice");
Route::get("/privacy-policy", [CmsController::class, "privacypolicy"])->name("privacypolicy");
Route::get("/refund-policy", [CmsController::class, "refundpolicy"])->name("refundpolicy");
Route::get("/shopping-policy", [CmsController::class, "shoppingpolicy"])->name("shoppingpolicy");
Route::get("/payment-policy", [CmsController::class, "paymentpolicy"])->name("paymentpolicy");
Route::get("/about-us", [CmsController::class, "aboutus"])->name("aboutus");
Route::get("/contact-us", [CmsController::class, "contactus"])->name("contactus");
Route::post('/contact-save', [CmsController::class, 'contactsave'])->name('contactsave');
Route::get("/faq", [CmsController::class, "faq"])->name("faq");
Route::get("/warranty", [CmsController::class, "warranty"])->name("warranty");
Route::get("/story-gallery", [CmsController::class, "storegallery"])->name("storegallery");

// Search & Category routes
Route::get("/category-products-collection/{slug}", [CategoryController::class, "index"])->name("categorylist");
Route::get("/child-category-products-collection/{slug}", [CategoryController::class, "childcategory"])->name("childcategorylist");
Route::get("/sub-category-products-collection/{slug}", [CategoryController::class, "subcategorylist"])->name("subcategorylist");
Route::get("/category/{slug}", [CategoryController::class, "category"])->name("category");
Route::get("/brand-product-products-collection/{slug}", [CategoryController::class, "shopbybrandlist"])->name("shopbybrandlist");
Route::get("/brand-product-list-filter", [CategoryController::class, "brandproductlistfilter"])->name("brandproductlistfilter");
Route::get("/brands", [CategoryController::class, "shopbybrand"])->name("shopbybrand");
Route::get("/deal-of-the-day", [CategoryController::class, "offer"])->name("offer");
Route::get("/product/{slug}", [ProductController::class, "index"])->name("product");

Route::get("/search-result", [ProductController::class, "search_result"])->name("search_result");
Route::get("/rating-submit", [ProductController::class, "rating_submit"])->name("rating_submit");
Route::post("/rating-update", [ProductController::class, "rating_update"])->name("rating_update");
Route::post("/notify", [ProductController::class, "notify"])->name("notify");
Route::post("/newsletter", [ProductController::class, "newsletter"])->name("newsletter");

Route::get('/load-more-categories', [CategoryController::class, 'loadMoreCategories'])->name('load.more.categories');


// User without Auth
Route::get("/user-login", [LoginController::class, "index"])->name("userlogin");
Route::post("/user-register", [LoginController::class, "userregister"])->name("userregister");
Route::post("/checklog", [LoginController::class, "checklog"])->name("checklog");
Route::get("/otp/{token}/{action?}", [OtpController::class, "index"])->name("otp");
Route::post("/customer-otp-verify", [OtpController::class, "customer_otp_verify"])->name("customer-otp-verify");
Route::post('/resend-otp', [OtpController::class, 'resendOtp'])->name('customer-resend-otp');
Route::get("/forget-password", [LoginController::class, "forgetpassword"])->name("forgetpassword");
Route::post("/forgot-password-otp-sent", [LoginController::class, "forgotpasswordotpsent"])->name("forgotpasswordotpsent");
Route::post("/new-password-change", [LoginController::class, "new_password_change"])->name("new_password_change");

// Seller routes
Route::get("/seller-login", [SellerController::class, "index"])->name("sellerlogin");
Route::post("/seller-register", [SellerController::class, "sellerregister"])->name("sellerregister");
Route::post("/seller-checklog", [SellerController::class, "sellerchecklog"])->name("sellerchecklog");
Route::get("/seller-otp/{token}/{action?}", [SellerController::class, "sellerotp"])->name("sellerotp");
Route::post("/seller-otp-verify", [SellerController::class, "sellerotpverify"])->name("sellerotpverify");
Route::post('/seller-resend-otp', [SellerController::class, 'sellerresendotp'])->name('sellerresendotp');

// Sellers Auth
Route::middleware(['seller.auth', 'no-cache'])->group(function () {
    Route::get("/seller-profile", [SellerController::class, "sellerprofile"])->name('sellerprofile');
    Route::get("/seller-logout", [SellerController::class, "sellerlogout"])->name('sellerlogout');
});

// Cart
Route::any('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::any('/update-cart', [CartController::class, 'update_cart'])->name('cart.update');
Route::any('/cart', [CartController::class, 'cart'])->name('cart');
Route::any('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::any('/update-cart-data', [CartController::class, 'update_cart_data'])->name('cart_data.update');
Route::any('/buy-now', [CartController::class, 'buy_now'])->name('cart.buy');
Route::any('/filter-review', [ProductController::class, 'filterReviews'])->name('filter_review');
Route::any("/invoice/{sid}", [CartController::class, "invoice"])->name("invoice");
Route::any('/pincode-check-delivery', [ProductController::class, 'checkDelivery'])->name('check_delivery');
Route::get('/track-order', [UserController::class, 'dashboardtrackorder'])->name('dashboardtrackorder');
//Users Auth
Route::middleware(['user.auth', 'no-cache'])->group(function () {
    Route::get("/user-profile", [UserController::class, "userprofile"])->name("userprofile");
    Route::post("/update-profile", [UserController::class, "updateprofile"])->name("updateprofile");
    Route::get("/user-orders", [UserController::class, "userorders"])->name("userorders");
    Route::get('/order/view', [UserController::class, 'view_order'])->name('order.view');
    Route::get("/user-wishlist", [UserController::class, "userwishlist"])->name("userwishlist");
    Route::get("/add-to-wishlist", [UserController::class, "addtowishlist"])->name("addtowishlist");
    Route::get("/user-addresses", [UserController::class, "useraddress"])->name("useraddress");
    Route::get("/user-edit-address/{id}", [UserController::class, "usereditaddress"])->name("usereditaddress");
    Route::get("/delete-address/{id}", [UserController::class, "deleteaddress"])->name("deleteaddress");
    Route::post("/user-update-address", [UserController::class, "userupdateaddress"])->name("userupdateaddress");
    Route::any("/add-address", [UserController::class, "add_address"])->name("add-address");
    Route::get("/user-reviews", [UserController::class, "userreviews"])->name("userreviews");
    Route::get("/user-rewards", [UserController::class, "userrewards"])->name("userrewards");
    Route::get("/user-logout", [UserController::class, "userlogout"])->name("userlogout");
    Route::post("/address-submit", [UserController::class, "address_submit"])->name("address_submit");
    Route::any('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::any('/bow-now-checkout', [CartController::class, 'buy_now_checkout'])->name('bow-now-checkout');
    Route::any('/make-payment', [CartController::class, 'make_payment'])->name('make-payment');
    Route::any('/buy-now-make-payment', [CartController::class, 'buy_now_make_payment'])->name('buy-now-make-payment');
    Route::any('/use-coupon', [CartController::class, 'use_coupon'])->name('use-coupon');
    Route::post("/cart-address-submit", [CartController::class, "cart_address_submit"])->name("cart_address_submit");
    Route::any('/payment', [CartController::class, 'payment'])->name('payment');
    Route::post("/initiate-payment", [CartController::class, "initiatepayment"])->name("initiatepayment");
    Route::any("/place-order", [CartController::class, "place_order"])->name("place_order");
    Route::any("/buy_now_place_order", [CartController::class, "buy_now_place_order"])->name("buy_now_place_order");
    Route::any("/order-success", [CartController::class, "order_success"])->name("order-success");

    Route::post("/change-address", [CartController::class, "change_address"])->name("change_address");
    Route::post("/change-address-payment", [CartController::class, "change_address_payment"])->name("change_address_payment");
});

// No Cache URL
Route::middleware(['no-cache'])->group(function () {
    Route::any("/realtime-search-result", [ProductController::class, "realtime_search_result"])->name("realtime_search_result");
});

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
