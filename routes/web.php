<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\OrderController;




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
//     return view('user_template.layouts.template');
// });

   //    fRONT -END
   Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('home');

});

Route::controller(ClientController::class)->group(function(){

    Route::get('/category/{id}/{slug}','CategoryPage')->name('category');
    Route::get('/product-details/{id}/{slug}','SingleProduct')->name('singleproduct');
    Route::get('/add-to-cart','AddToCart')->name('addtocart');
    Route::get('/checkeout','Checkeout')->name('checkeout');
    Route::get('/user-profile','UserProfile')->name('userprofile');

    Route::get('/new-release','NewRelease')->name('newrelease');
    Route::get('/todays-deal','TodaysDeal')->name('todaysdeal');
    Route::get('/customer-service','CustomerService')->name('customerservice');

});

Route::middleware(['auth','role:user'])->group(function(){

    Route::controller(ClientController::class)->group(function(){
        Route::get('/add-to-cart','AddToCart')->name('addtocart');
        Route::get('/checkeout','Checkeout')->name('checkeout');

        Route::get('/user-profile','UserProfile')->name('userprofile');
        Route::get('/user-profile/pending-orders','PendingOrders')->name('pendingorders');
        Route::get('user-profile/history','History')->name('history');

        Route::get('/todays-deal','TodaysDeal')->name('todaysdeal');
        Route::get('/customer-service','CustomerService')->name('customerservice');

    });

});





            //  BACK-END
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');
// ->middleware(['auth', 'role:user'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth','role:admin')->group(function () {
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin/dashboard','index')->name('dashborad');

    });



    //    Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category','index')->name('allcategory');
        Route::get('/admin/add-category','AddCategory')->name('addcategory');

        Route::post('/admin/store-category','StoreCategory')->name('storecategory');
        Route::get('/admin/edit-category/{id}','EditCategory')->name('editcategory');
        Route::get('/admin/delete-category/{id}','DeleteCategory')->name('deletecategory');
        Route::post('/admin/update-category','UpdateCategory')->name('updatecategory');


    });

    //   Sub- Category
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/all-subcategory','index')->name('allsubcategory');
        Route::get('/admin/add-subcategory','AddSubCategory')->name('addsubcategory');

        Route::post('/admin/store-subcategory','StoreSubCategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{id}','EditSubCategory')->name('editsubcat');
        Route::get('/admin/delete-subcategory/{id}','DeleteSubCategory')->name('deletesubcat');

        Route::post('/admin/update-subcategory','UpdateSubCat')->name('updatesubcat');




    });


    //    Products Controller
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-products','index')->name('allproducts');
        Route::get('/admin/add-product','Addproduct')->name('addproduct');
        Route::post('/admin/store-product','StoreProduct')->name('storeproduct');

        //Product Image Edit and new image upload

        Route::get('/admin/edit-product-img/{id}','EditProductImg')->name('editproductimg');
        Route::post('/admin/update-product-img','UpdateProductImg')->name('updateproductimg');

        Route::get('/admin/edit-product/{id}','EditProduct')->name('editproduct');
        Route::post('/admin/update-product','UpdateProduct')->name('updateproduct');
        Route::get('/admin/delete-product/{id}','DeleteProduct')->name('deleteproduct');





    });


    //    OrderController
    Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/pending-order','index')->name('pendingorder');
        // Route::get('/admin/add-order','Addorder')->name('addorder');


    });

});


require __DIR__.'/auth.php';
