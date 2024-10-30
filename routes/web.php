<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CategoriesController;

Route::get('/dashboard', function () {
    return view('layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('index');
    Route::post('/customer/submit', [CustomerController::class, 'create'])->name('create');
    Route::get('/customer/show', [CustomerController::class, 'show']) -> name('customer.show');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/customer/update', [CustomerController::class, 'update']);
    Route::get('/delete/{id}', [CustomerController::class, 'destroy']);
    Route::get('/customerlist', [ProductController::class, 'customertList'])->name('customerlist');

});


Route::middleware('auth')->group(function () {
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('/categories/submit', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/show', [CategoriesController::class, 'show']);
    Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update', [CategoriesController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{id}', [CategoriesController::class, 'destroy']);
});



Route::middleware('auth')->group(function () {
    Route::get('/brands', [BrandsController::class, 'index'])->name('index');
    Route::post('/brands/submit', [BrandsController::class, 'create'])->name('create');
    Route::get('/brands/show', [BrandsController::class, 'show']) -> name('brands.show');
    Route::get('/brands/edit/{id}', [BrandsController::class, 'edit']);
    Route::post('/brands/update', [BrandsController::class, 'update']);
    Route::get('/delete/{id}', [BrandsController::class, 'destroy']);
});


Route::middleware('auth')->group(function () {
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductController::class, 'edit']);
Route::put('/products/update/{id}', [ProductController::class, 'update']);
Route::delete('/products/delete/{id}', [ProductController::class, 'destroy']);

Route::get('/productlist', [ProductController::class, 'productList'])->name('productlist');



});


Route::middleware('auth')->group(function () {
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});



Route::middleware('auth')->group(function () {
    Route::get('/show/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');
    Route::get('/sale', [InvoiceController::class, 'indexa'])->name('sale.indexa');

 });


Route::middleware('auth')->group(function () {
Route::get('/backup', [BackupController::class, 'createBackup'])->name('backup.create');

});






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

