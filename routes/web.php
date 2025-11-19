<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\InfoController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\InstructorController;
use App\Http\Controllers\backend\SubcategoryController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\AdminInstructorController;
use App\Http\Controllers\backend\InstructorProfileController;
use App\Http\Controllers\frontend\FrontendDashboardController;




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Admin Routes */

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');

         /*  control Profile */

    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profile/store', [AdminProfileController::class, 'store'])->name('profile.store');
    Route::get('/setting', [AdminProfileController::class, 'setting'])->name('setting');
    Route::post('/password/setting', [AdminProfileController::class, 'passwordSetting'])->name('passwordSetting');

     /*  control Category & Subcategory  */

    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubcategoryController::class);

    /* Control Slider */
    Route::resource('slider', SliderController::class);

    // info controller
 Route::resource('info', InfoController::class);


//Controll instructor

 Route::resource('instructor', AdminInstructorController::class);
    Route::post('/update-status', [AdminInstructorController::class, 'updateStatus'])->name('instructor.status');
    Route::get('/instructor-active-list', [AdminInstructorController::class, 'instructorActive'])->name('instructor.active');

 


    });

    /*  Instructor Route  */
Route::get('/instructor/login', [InstructorController::class, 'login'])->name('instructor.login');

Route::middleware(['auth', 'verified', 'role:instructor'])
    ->prefix('instructor')
    ->name('instructor.')
    ->group(function () {
        Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [InstructorController::class, 'destroy'])->name('logout');
//profile route:
        Route::get('/profile', [InstructorProfileController::class, 'index'])->name('profile');
        Route::get('/setting', [InstructorProfileController::class, 'setting'])->name('setting');
        Route::post('/password/setting', [AdminProfileController::class, 'passwordSetting'])->name('passwordSetting');
        Route::post('/profile/store', [AdminProfileController::class, 'store'])->name('profile.store');



        Route::resource('course', CourseController::class);
        Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubcategories']);


        
    });


// // Normal user profile routes
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

  
//     Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('slider', SliderController::class);
// });


// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('info', InfoController::class);
// });




//Frontend Route

Route::get('/', [FrontendDashboardController::class, 'home'])->name('frontend.home');




/* Cart Controller */
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/all', [CartController::class, 'cartAll']);
Route::get('/fetch/cart', [CartController::class, 'fetchCart']);
Route::post('/remove/cart', [CartController::class, 'removeCart']);

// Authentication routes (Breeze/Fortify/etc.)
require __DIR__.'/auth.php';
