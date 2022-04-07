<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\CartPageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\User\WishListController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

// Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
//     return view('admin.index');
// })->name('dashboard')->middleware('auth:admin');
Route::middleware(['auth:admin'])->group(function(){
    
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
    
    //Admin All Routes
    
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('admin.update.change.password');
});


//User All Routes
// Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
//     $id = Auth::user()->id;
//     $user = User::find($id);
//     return view('dashboard', compact('user'));
// })->name('dashboard');

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
	$id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/user/password/change', [IndexController::class, 'userPasswordChange'])->name('user.password.change');
Route::post('/user/password/change', [IndexController::class, 'userPasswordStore'])->name('user.password.store');
Route::group(['prefix' => 'brand'], function(){
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});

Route::group(['prefix' => 'category'], function(){
    //Category
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

    //Sub Category
    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

    //Sub Sub Category
    Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
    Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
});

Route::group(['prefix' => 'product'], function(){
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    Route::get('/view/{id}', [ProductController::class, 'ViewProduct'])->name('product.view');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
    Route::post('/update', [ProductController::class, 'UpdateProduct'])->name('product-update');
    Route::post('/update/image', [ProductController::class, 'UpdateProductImage'])->name('product-update-image');
    Route::post('/update/thambnail/image', [ProductController::class, 'UpdateProductThambnailImage'])->name('product-update-thambnail-image');
    Route::get('/delete/multimage{id}', [ProductController::class, 'DeleteProductMultiImage'])->name('product-multi-image');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});

Route::group(['prefix' => 'slider'], function(){
    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
});

Route::get('/english/language', [LanguageController::class, 'English'])->name('english.language');
Route::get('/hindi/language', [LanguageController::class, 'Hindi'])->name('hindi.language');

//Frontend Product Details Page
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails'])->name('product.details');
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct'])->name('product.tag');
Route::get('/subcategory/product/{id}/{slug}', [IndexController::class, 'SubcategoryWiseProduct'])->name('subcategory.product');
Route::get('/subsubcategory/product/{id}/{slug}', [IndexController::class, 'SubSubcategoryWiseProduct'])->name('subsubcategory.product');

//Product view with Ajax

Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

//Add To Cart With Ajax
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Show Mini Cart Using Ajax

Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

//Remove Mini Cart
Route::get('minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

//Wish List
Route::post('/add-to-wishlist/{productId}', [CartController::class, 'AddToWishList']);
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function(){
    //Wish List Page
    Route::get('/wishlist', [WishListController::class, 'ViewWishList'])->name('wishlist');

    //Wish List
    Route::get('/get-wishlist-product', [WishListController::class, 'GetWishListProduct']);

    //Wish List Remove
    Route::get('/wishlist-remove/{rowId}', [WishListController::class, 'RemoveWishListProduct']);
});
//My Cart
Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');

//Cart List
Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);

//Remove My Cart
Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);

//Increment My Cart
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);

//Decrement My Cart
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

//Coupon Management
Route::group(['prefix' => 'coupons'], function(){
    Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
    Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
    Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
    Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
});

//Shipping Management
Route::group(['prefix' => 'shipping'], function(){
    //Division
    Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
    Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
    Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
    Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');

    //District
    Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');
    Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
    Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
    Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
    Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');

    //State
    Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage-state');
    Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');
    Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');
    Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');
    Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');

    Route::get('/division/district/ajax/{division_id}', [ShippingAreaController::class, 'GetDistrict']);
});


