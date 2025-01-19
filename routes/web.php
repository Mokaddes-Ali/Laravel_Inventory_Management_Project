<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingsController;


// Route::get('/dashboard', function () {
//     return view('layouts.master');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('index');
    Route::post('/customer/submit', [CustomerController::class, 'create'])->name('create');
    Route::get('/customer/show', [CustomerController::class, 'show']) -> name('customer.show');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/customer/update', [CustomerController::class, 'update']);
    Route::get('/delete/{id}', [CustomerController::class, 'destroy']);

    Route::get('/customer/{id}', [CustomerController::class, 'dataShow'])->name('customer.dataShow');

    //for invoice
    Route::get('/customerlist', [CustomerController::class, 'customerList']);
    Route::get('/customer-export1', [CustomerController::class, 'export1']);
    Route::get('/customer-export2', [CustomerController::class, 'export2']);
    Route::get('/customer-export3', [CustomerController::class, 'export3']);

    //search cutomer
    Route::get('/search-customers', [CustomerController::class, 'searchCustomers']);


});


Route::middleware('auth')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/submit', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/show', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/category/{id}', [CategoryController::class, 'dataShow'])->name('category.dataShow');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/category/{id}', [CategoryController::class, 'destroy']);

    //export
    Route::get('/category-export1', [CategoryController::class, 'export1']);
    Route::get('/category-export2', [CategoryController::class, 'export2']);
    Route::get('/category-export3', [CategoryController::class, 'export3']);
});



Route::middleware('auth')->group(function () {
    Route::get('/brands', [BrandController::class, 'index'])->name('index');
    Route::post('/brands/submit', [BrandController::class, 'create'])->name('create');
    Route::get('/brands/show', [BrandController::class, 'show']) -> name('brands.show');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit']);
    Route::post('/brands/update', [BrandController::class, 'update']);
    Route::get('/delete/{id}', [BrandController::class, 'destroy']);

    Route::get('/brands/{id}', [BrandController::class, 'dataShow'])->name('brands.dataShow');



    //export
    Route::get('/brand-export1', [BrandController::class, 'export1']);
    Route::get('/brand-export2', [BrandController::class, 'export2']);
    Route::get('/brand-export3', [BrandController::class, 'export3']);
});


Route::middleware('auth')->group(function () {
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductController::class, 'edit']);
Route::put('/products/update/{id}', [ProductController::class, 'update']);
Route::delete('/products/delete/{id}', [ProductController::class, 'destroy']);

// In web.php
Route::get('/products/{id}', [ProductController::class, 'dataShow'])->name('product.dataShow');


//for product list in use invoice
Route::get('/productlist', [ProductController::class, 'ProductList']);

 //export
 Route::get('/product-export1', [ProductController::class, 'export1']);
 Route::get('/product-export2', [ProductController::class, 'export2']);
 Route::get('/product-export3', [ProductController::class, 'export3']);

});



Route::middleware('auth')->group(function () {

Route::post('/invoices', [InvoiceController::class, 'submitInvoice'])->name('submitInvoice');
Route::get('/invoices/show', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/view/salelist/{id}', [InvoiceController::class, 'salelist'])->name('salelist');
Route::get('/view/salelist/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');
Route::get('/delete/invoice/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
 //export
 Route::get('/sale-export1', [InvoiceController::class, 'export1']);
 Route::get('/sale-export2', [InvoiceController::class, 'export2']);
 Route::get('/sale-export3', [InvoiceController::class, 'export3']);

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
Route::resource('roles', RoleController::class);
Route::get('/role', [RoleController::class, 'create']);

Route::get('/backup', [BackupController::class, 'createBackup'])->name('backup.create');

});


Route::group(['middleware' => ['auth']], function() {
Route::get('/user', [UserController::class, 'create']);
Route::get('/show', [UserController::class, 'index']);
Route::resource('users', UserController::class);
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

  });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

