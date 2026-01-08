<?php

use App\Models\CourseLecture;
use Illuminate\Support\Facades\Route;
  


use App\Http\Controllers\SocialController;
use App\Http\Controllers\LectureController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\InfoController;

use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\admin\BenefitController;
use App\Http\Controllers\admin\FunfactController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\PartnerController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\frontend\ProceedController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\frontend\CallbackController;

use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\backend\CtaSectionController;
use App\Http\Controllers\backend\InstructorController;
use App\Http\Controllers\backend\AdminCourseController;
use App\Http\Controllers\backend\SiteSettingController;
use App\Http\Controllers\backend\SubcategoryController;
use App\Http\Controllers\backend\UserProfileController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\BackendOrderController;
use App\Http\Controllers\backend\ItDepartmentController;
use App\Http\Controllers\backend\CourseSectionController;
use App\Http\Controllers\backend\AdministrationController;
use App\Http\Controllers\backend\CallbackOptionController;
use App\Http\Controllers\backend\AdminInstructorController;
use App\Http\Controllers\backend\CallbackSectionController;
use App\Http\Controllers\backend\RealLifeSectionController;
use App\Http\Controllers\backend\InstructorProfileController;
use App\Http\Controllers\frontend\FrontendDashboardController;
use App\Http\Controllers\backend\CallbackController as AdminCallbackController;




/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

/*  Google Route  */

Route::get('/auth/google', [SocialController::class, 'googleLogin'])->name('auth.google');
Route::get('/auth/google-callback', [SocialController::class, 'googleAuthentication'])->name('auth.google-callback');



/* Admin Route   */

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');


Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'destroy'])
        ->name('logout');

    /*  control Profile */

    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profile/store', [AdminProfileController::class, 'store'])->name('profile.store');
    Route::get('/setting', [AdminProfileController::class, 'setting'])->name('setting');
    Route::post('/password/setting', [AdminProfileController::class, 'passwordSetting'])->name('passwordSetting');


     // Benefit CRUD


Route::resource('benefit', BenefitController::class);

Route::resource('funfacts', FunfactController::class);

Route::resource('testimonials', TestimonialController::class);


//call back
 Route::get('callback-requests', [AdminCallbackController::class, 'index'])->name('callback.index');
 Route::resource('callback-section', CallbackSectionController::class);


 
// IT Department Routes
Route::resource('it-department', ItDepartmentController::class);

// Administration Routes
Route::resource('administration', AdministrationController::class);


// Blog Routes
Route::resource('blog', \App\Http\Controllers\backend\BlogController::class);
Route::delete('/blog-image/{image}', [BlogController::class, 'deleteImage'])->name('admin.blog.image.delete');


// Real Life Section Routes
Route::resource('real-life-section', RealLifeSectionController::class);

// CTA Section Routes
Route::resource('cta-section', CtaSectionController::class);

 


    /*  control Category & Subcategory  */

    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubcategoryController::class);

    /* Control Slider */
    Route::resource('slider', SliderController::class);

     /* control Course  */

    Route::resource('course', AdminCourseController::class);
    Route::post('/course-status', [AdminCourseController::class, 'courseStatus'])->name('course.status');

    /*  order controller  */
    Route::resource('order', BackendOrderController::class);

    /* Mange Info */
    Route::resource('info', InfoController::class);

    /* control instructor  */
    Route::resource('instructor', AdminInstructorController::class);
    Route::post('/update-status', [AdminInstructorController::class, 'updateStatus'])->name('instructor.status');
    Route::get('/instructor-active-list', [AdminInstructorController::class, 'instructorActive'])->name('instructor.active');

    Route::get('/team/trainers', [AdminInstructorController::class, 'trainers'])->name('admin.team.trainers');

    Route::get('/instructor/{id}/edit', [AdminInstructorController::class, 'edit'])->name('admin.instructor.edit');
    Route::put('/instructor/{id}', [AdminInstructorController::class, 'update'])->name('admin.instructor.update');

    Route::get('instructor/create', [AdminInstructorController::class, 'create'])->name('instructor.create');
    Route::post('instructor/store', [AdminInstructorController::class, 'store'])->name('instructor.store');
    /*  Setting Controller */
    Route::get('/mail-setting', [SettingController::class, 'mailSetting'])->name('mailSetting');
    Route::put('/mail-settings/update', [SettingController::class, 'updateMailSettings'])->name('mail.settings.update');

    Route::get('/stripe-setting', [SettingController::class, 'stripeSetting'])->name('stripeSetting');
    Route::post('/stripe-settings/update', [SettingController::class, 'updateStripeSettings'])->name('stripe.settings.update');

    Route::get('/google-setting', [SettingController::class, 'googleSetting'])->name('googleSetting ');
    Route::post('/google-settings/update', [SettingController::class, 'updateGoogleSettings'])->name('google.settings.update');

     /* Manage Partner  */

    Route::resource('partner', PartnerController::class);

     /* Manage Site Seetings */
    Route::resource('site-setting', SiteSettingController::class);



});


/*  Instructor Route  */
Route::get('/instructor/login', [InstructorController::class, 'login'])->name('instructor.login');
Route::get('/instructor/register', [InstructorController::class, 'register'])->name('instructor.register');
Route::middleware(['auth', 'verified', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [InstructorController::class, 'destroy'])
        ->name('logout');

    Route::get('/profile', [InstructorProfileController::class, 'index'])->name('profile');
    Route::post('/profile/store', [InstructorProfileController::class, 'store'])->name('profile.store');
    Route::get('/setting', [InstructorProfileController::class, 'setting'])->name('setting');
    Route::post('/password/setting', [InstructorProfileController::class, 'passwordSetting'])->name('passwordSetting');

    Route::resource('course', CourseController::class);
    Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubcategories']);

    Route::resource('course-section', CourseSectionController::class);

    Route::resource('lecture', LectureController::class);

    Route::resource('coupon', CouponController::class);
});


//user Route

Route::middleware(['auth', 'verified', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [UserController::class, 'destroy'])
        ->name('logout');

    //Profile

    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::post('/profile/store', [UserProfileController::class, 'store'])->name('profile.store');
    Route::get('/setting', [UserProfileController::class, 'setting'])->name('setting');
    Route::post('/password/setting', [UserProfileController::class, 'passwordSetting'])->name('passwordSetting');

    /* Wishlist controller */

    // Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    // Route::get('/wishlist-data', [WishlistController::class, 'getWishlist']);
    // Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

Route::get('lecture/{courseLecture}/resource/preview', [LectureController::class, 'preview'])
    ->name('lecture.preview');

Route::get('lecture/{courseLecture}/resource/download', [LectureController::class, 'download'])
    ->name('lecture.download');


    // Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    // Route::post('/checkout/demo', [CheckoutController::class, 'demoPayment'])->name('checkout.demo');


    Route::post('/callback', [CallbackController::class, 'store'])->name('callback.store');
    // Route::middleware(['auth', 'user'])->group(function () {
    //  Route::post('/demo/pay', [DemoPaymentController::class, 'pay'])
    //    ->name('demo.pay');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/my-courses', [UserController::class, 'myCourses'])->name('user.myCourses');
});
Route::middleware(['auth'])->group(function () {
    // Show course learning page
    Route::get('user/learn/{id}', [App\Http\Controllers\backend\UserController::class, 'learn'])
        ->name('course.learn');
});




});


Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/demo', [CheckoutController::class, 'demoPayment'])->name('checkout.demo');
});


//Frontend Route

Route::get('/', [FrontendDashboardController::class, 'home'])->name('frontend.home');
Route::get('/course-details/{id}', [FrontendDashboardController::class, 'view'])->name('course-details');

//trainers route
Route::get('/trainers', [FrontendDashboardController::class, 'trainers'])->name('trainers.page');

Route::get('/trainer/{id}', [FrontendDashboardController::class, 'trainerDetails'])->name('trainer.details');


Route::get('/administration', [FrontendDashboardController::class, 'administration'])->name('administration.page');


// search route
Route::get('/search', [FrontendDashboardController::class, 'search'])->name('course.search');

// Add this after your search route
Route::get('/search/autocomplete', [FrontendDashboardController::class, 'autocomplete'])->name('search.autocomplete');


Route::get('/it-department', [FrontendDashboardController::class, 'itDepartment'])->name('it-department.page');


// Show the callback form
Route::get('/callback', [CallbackController::class, 'index'])->name('callback.form');

// Handle form submission
Route::post('/callback', [CallbackController::class, 'store'])->name('callback.store');



/* wishlist controller  */

// Route::get('/wishlist/all', [WishlistController::class, 'allWishlist']);
// Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);

/* Cart Controller */
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/all', [CartController::class, 'cartAll']);
Route::get('/fetch/cart', [CartController::class, 'fetchCart']);
Route::post('/remove/cart', [CartController::class, 'removeCart']);


/*  Checkout */
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
/* Coupon Apply    */
Route::post('/apply-coupon', [CouponController::class, 'applyCoupon']);

//call back route
// Route::get('/call-book', function () {
//     return view('frontend.section.callback');
// })->name('call.book.page');


/* Auth Protected Route */

Route::middleware('auth')->group(function () {

    /* Order  */
    Route::post('/order', [OrderController::class, 'order'])->name('order');
    Route::get('/payment-success', [OrderController::class, 'success'])->name('success');
    Route::get('/payment-cancel', [OrderController::class, 'cancel'])->name('cancel');
    //Route::resource('rating', RatingController::class);
});

Route::get('/proceed', [ProceedController::class, 'proceed'])->name('proceed.page');
Route::post('/proceed/payment', [ProceedController::class, 'proceedPayment'])->name('proceed.payment');

Route::get('/courses', [\App\Http\Controllers\backend\CourseController::class, 'allCourses'])->name('courses.all');

Route::get('/category/{id}', [\App\Http\Controllers\frontend\CategoryController::class, 'show'])
     ->name('category.show');


   

Route::get('/blog', [FrontendDashboardController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [FrontendDashboardController::class, 'blogDetails'])->name('blog.details');









require __DIR__ . '/auth.php';
