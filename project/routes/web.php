<?php

use App\Http\Controllers\AuthController\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\Profile\General as ProfileGeneral;
use App\Http\Controllers\Users\General as UsersGeneral;
use App\Http\Controllers\Settings\General as SettingsGeneral;
use App\Http\Controllers\Settings\Contact as SettingsContact;
use App\Http\Controllers\Settings\Social as SettingsSocial;
use App\Http\Controllers\Settings\Sliders as SettingsSlider;
use App\Http\Controllers\Customers\General as CustomersGeneral;
use App\Http\Controllers\Products\Categories;
use App\Http\Controllers\Products\Product;


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

Route::middleware('isLogin')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'login_post'])->name('login_post');
});

Route::middleware('isLogout')->group(function () {
    Route::get("/", [GeneralController::class, "index"])->name("index");
    Route::get('/logout', [LoginController::class, 'logout'])->name("logout");

    // profile
    Route::get("/my-profile", [ProfileGeneral::class, "index"])->name("indexProfile");
    Route::post("/my-profile", [ProfileGeneral::class, "myProfileEdit"])->name("myProfileEdit");

    Route::get("/users/list", [UsersGeneral::class, "usersGet"])->name("usersGet");
    Route::post("/users/list/edit", [UsersGeneral::class, "userEdit"])->name("userEdit");
    Route::post("/user/view", [UsersGeneral::class, "getUser"]);
    Route::post("/users/list/add", [UsersGeneral::class, "userAdd"])->name("userAdd");


    /// Settings
    /// General
    Route::get("/settings/general", [SettingsGeneral::class, "generalIndex"])->name("generalIndex");
    Route::post("/settings/general", [SettingsGeneral::class, "generalPost"])->name("generalPost");
    Route::post("/settings/general/logo", [SettingsGeneral::class, "logoChange"])->name("logoChange");
    ///Contact
    Route::get("/settings/contact", [SettingsContact::class, "contactIndex"])->name("contactIndex");
    Route::post("/settings/contact", [SettingsContact::class, "contactPost"])->name("contactPost");
    ///Social
    Route::get("/settings/social_media", [SettingsSocial::class, "socialIndex"])->name("socialIndex");
    Route::post("/settings/social_media", [SettingsSocial::class, "socialPost"])->name("socialPost");
    ///Sliders
    Route::get("/settings/slider", [SettingsSlider::class, "sliderIndex"])->name("sliderIndex");
    Route::post("/settings/slider", [SettingsSlider::class, "sliderPost"])->name("sliderPost");
    Route::get("/settings/slider/delete/{id}", [SettingsSlider::class, "sliderDelete"])->name("sliderDelete");
    Route::post("/slider/view", [SettingsSlider::class, "getSlider"]);
    Route::post("/settings/slider/edit", [SettingsSlider::class, "sliderEdit"])->name("sliderEdit");


    // Customer
    Route::get("/customers/list", [CustomersGeneral::class, "CustomersList"])->name("CustomersList");
    Route::post("/customer/view", [CustomersGeneral::class, "CustomersView"])->name("CustomersView");
    Route::post("/customer/edit", [CustomersGeneral::class, "CustomersEdit"])->name("CustomersEdit");


    /// Products
    Route::get("/products/category-list", [Categories::class, "categoriesListIndex"])->name("categoriesListIndex");
    Route::get("/products/category-add", [Categories::class, "categoriesAddIndex"])->name("categoriesAddIndex");
    Route::post("/products/category-add", [Categories::class, "categoriesAddPost"])->name("categoriesAddPost");
    Route::post("/products/category/view", [Categories::class, "categoriesView"]);
    Route::post("/products/category/edit", [Categories::class, "categoriesEdit"])->name("categoriesEdit");
    Route::get("/products/category/delete/{id}", [Categories::class, "delete"])->name("deleteCategory");

    Route::get("/products/product-add", [Product::class, "ProductAddIndex"])->name("ProductAddIndex");
    Route::post("/products/product-add", [Product::class, "ProductAddPost"])->name("ProductAddPost");
    Route::get("/products/products-list", [Product::class, "ProductsList"])->name("ProductsList");
    Route::post("/product/view", [Product::class, "ProductView"])->name("CustomersView");
    Route::get("/products/product-delete/{id}", [Product::class, "ProductDelete"]);
    Route::post("/products/product-edit", [Product::class, "ProductEdit"])->name("ProductEdit");
    Route::post("/products/product/view", [Product::class, "ProductGet"]);
});

