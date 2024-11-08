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

    //for invoice
    Route::get('/customerlist', [CustomerController::class, 'customerList']);
    Route::get('/customer-export', [CustomerController::class, 'export']);

    //search cutomer
    Route::get('/search-customers', [CustomerController::class, 'searchCustomers']);


});


Route::middleware('auth')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/submit', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/show', [CategoryController::class, 'show']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/category/{id}', [CategoryController::class, 'destroy']);
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

//for product list in use invoice
Route::get('/productlist', [ProductController::class, 'ProductList']);
//search product
Route::get('/search-products', [ProductController::class, 'searchProducts']);



});



Route::middleware('auth')->group(function () {

    Route::post('/invoices', [InvoiceController::class, 'submitInvoice'])->name('submitInvoice');
    Route::get('/invoices/show', [InvoiceController::class, 'index'])->name('invoices.index');

Route::get('/view/salelist/{id}', [InvoiceController::class, 'salelist'])->name('salelist');
Route::get('/view/salelist/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');
Route::get('/delete/invoice/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
});

Route::middleware('auth')->group(function () {

    // for sale invoice
    Route::get('/sale', [InvoiceController::class, 'saleIndex'])->name('sell.index');
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

