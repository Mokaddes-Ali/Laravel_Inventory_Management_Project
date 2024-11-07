<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingsController;
use App\Models\Category;

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


// Route::middleware('auth')->group(function () {
//     Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
//     Route::post('/category/submit', [CategoryController::class, 'store'])->name('categories.store');
//     Route::get('/category/show', [CategoryController::class, 'show']);
//     Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
//     Route::post('/category/update', [CategoryController::class, 'update'])->name('categories.update');
//     Route::get('/category/delete/{id}', [CategoryController::class, 'destroy']);
// });



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

Route::get('/productlist', [ProductController::class, 'ProductList']);



});



Route::middleware('auth')->group(function () {
// Route to show all invoices
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');

// Route to show the form to create a new invoice
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');

// Route to store a new invoice
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');

// Route to show the form to edit an existing invoice
Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');

// Route to update an existing invoice
Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');

// Route to delete an existing invoice
Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
});


Route::middleware('auth')->group(function () {
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});



Route::middleware('auth')->group(function () {
    Route::get('/show/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');
    Route::get('/sale', [InvoiceController::class, 'saleIndex'])->name('sale.indexa');

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

