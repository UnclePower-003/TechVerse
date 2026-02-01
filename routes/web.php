<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BuildupController;
use App\Http\Controllers\Frontend\CardsDetailsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductsController;
use App\Http\Controllers\Frontend\ProjectsController;
use App\Http\Controllers\Frontend\ServicesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('welcom', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

// Frontend routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/buildup', [BuildupController::class, 'index'])->name('buildup');

Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.submit');

// projects
Route::get('/cardsdetails', [CardsDetailsController::class, 'index'])->name('cardsdetails');

use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Dashboard (Admin + Super Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin_role'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Profile (Admin + Super Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin_role'])->group(function () {
        Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Super Admin Only — Manage Admins/Super Admins
    |--------------------------------------------------------------------------
    */
    Route::middleware(['super_admin'])->group(function () {
        Route::resource('/admin/dashboard/users', AdminUsersController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Admin + Super Admin — Shared Dashboard Resources
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin_role'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('/admin/dashboard/home-hero', \App\Http\Controllers\Admin\HomeHeroController::class);
        Route::resource('/admin/dashboard/hero-header', \App\Http\Controllers\Admin\HeroHeaderController::class);
        Route::resource('/admin/dashboard/home-stat', \App\Http\Controllers\Admin\HomeStatController::class)->only(['index', 'edit', 'update']);

        Route::resource('/admin/dashboard/services-hero', \App\Http\Controllers\Admin\ServicesHeroController::class);
        Route::resource('/admin/dashboard/service-header', \App\Http\Controllers\Admin\ServiceHeaderController::class);
        Route::resource('/admin/dashboard/service-list', \App\Http\Controllers\Admin\ServiceListController::class);
        Route::resource('/admin/dashboard/home-partners', \App\Http\Controllers\Admin\HomePartnerController::class);
        Route::resource('/admin/dashboard/contact-hero', \App\Http\Controllers\Admin\ContactHeroController::class);
        Route::resource('/admin/dashboard/contact-header', \App\Http\Controllers\Admin\ContactHeaderController::class);
        Route::resource('/admin/dashboard/contact-info', \App\Http\Controllers\Admin\ContactInfoController::class);
        Route::resource('/admin/dashboard/contact-support-promise', \App\Http\Controllers\Admin\ContactSupportPromiseController::class);
        Route::resource('/admin/dashboard/contact-choose', \App\Http\Controllers\Admin\ContactChooseController::class);
        Route::resource('/admin/dashboard/service-pick', \App\Http\Controllers\Admin\ServicePickController::class);
        Route::resource('/admin/dashboard/social-links', \App\Http\Controllers\Admin\SocialLinkController::class);
        Route::resource('/admin/dashboard/project-hero', \App\Http\Controllers\Admin\ProjectHeroController::class);
        Route::resource('/admin/dashboard/project-header', \App\Http\Controllers\Admin\ProjectHeaderController::class);
        Route::resource('/admin/dashboard/project-quality', \App\Http\Controllers\Admin\ProjectQualityController::class);
        Route::resource('/admin/dashboard/about-hero', \App\Http\Controllers\Admin\AboutHeroController::class);
        Route::resource('/admin/dashboard/about-header', \App\Http\Controllers\Admin\AboutHeaderController::class);
        Route::resource('/admin/dashboard/about-expertise', \App\Http\Controllers\Admin\AboutExpertiseController::class);
        Route::resource('/admin/dashboard/about-drive', \App\Http\Controllers\Admin\AboutDriveController::class);
        Route::resource('/admin/dashboard/about-highlight', \App\Http\Controllers\Admin\AboutHighlightController::class);
        Route::resource('/admin/dashboard/about-promise', \App\Http\Controllers\Admin\AboutPromiseController::class);
        Route::resource('/admin/dashboard/products-hero', \App\Http\Controllers\Admin\ProductsHeroController::class);
        Route::resource('/admin/dashboard/products-header', \App\Http\Controllers\Admin\ProductsHeaderController::class);

        Route::get('/admin/dashboard/contact-submission', [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'index'])->name('contact-submission.index');

        Route::get('/admin/dashboard/contact-submission/{contactSubmission}', [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'show'])->name('contact-submission.show');

        Route::delete('/admin/dashboard/contact-submission/{contactSubmission}', [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'destroy'])->name('contact-submission.destroy');

        Route::patch('/admin/dashboard/contact-submission/{contactSubmission}/read', [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'markRead'])->name('contact-submission.read');

        Route::patch('/admin/dashboard/contact-submission/{contactSubmission}/unread', [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'markUnread'])->name('contact-submission.unread');
    });
});
