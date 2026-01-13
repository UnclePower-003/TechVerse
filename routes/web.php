<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CardsDetailsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductsController;
use App\Http\Controllers\Frontend\ProjectsController;
use App\Http\Controllers\Frontend\ServicesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('welcom', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Frontend routes
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/services', [ServicesController::class,'index'])->name('services');
Route::get('/about', [AboutController::class,  'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/products', [ProductsController::class,   'index'])->name('products');
Route::get('/projects', [ProjectsController::class,  'index'])->name('projects');

// projects 
Route::get('/cardsdetails', [CardsDetailsController::class, 'index'])->name('cardsdetails');

