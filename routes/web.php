<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;

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


Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

});



// Route::middleware('auth')->group(function () {
//     Route::get('/client', [ClientController::class, 'index'])->name('index');
//     Route::post('/client/submit', [ClientController::class, 'store'])->name('store');
//     Route::get('/client/show', [ClientController::class, 'show'])->name('show');
//     Route::get('/client/edit/{id}', [ClientController::class, 'edit']);
//     Route::post('/client/update', [ClientController::class, 'update']);
//     Route::get('/delete/{id}', [ClientController::class, 'destroy']);
// });



// Route::middleware('auth')->group(function () {
//     Route::get('/project', [ProjectController::class, 'index'])->name('index');
//     Route::post('/project/submit', [ProjectController::class, 'store'])->name('store');
//     Route::get('/show/project', [ProjectController::class, 'projectshow'])->name('projectshow');
//     Route::get('/edit/project/{id}', [ProjectController::class, 'projectedit'])->name('projectedit');
//     Route::post('/project/update', [ProjectController::class, 'projectupdate'])->name('projectupdate');
//     Route::post('/delete/{id}', [ProjectController::class, 'projectdestroy'])->name('projectdestroy');
// });



// Route::middleware('auth')->group(function () {
//     Route::get('/income', [IncomeController::class, 'incomeindex'])->name('incomeindex');
//     Route::post('/income/submit', [IncomeController::class, 'incomestore'])->name('incomestore');
//     Route::get('/show/income', [IncomeController::class, 'incomeshow'])->name('incomeshow');
//     Route::get('/income/edit/{id}', [IncomeController::class, 'edit'])->name('incomeedit');
//     Route::post('/income/update', [IncomeController::class, 'update'])->name('incomeupdate');
//     Route::get('/invoice/filter', [IncomeController::class, 'filter'])->name('invoice.filter');
//     Route::delete('/income/delete/{id}', [IncomeController::class, 'destroy'])->name('income.delete');
//     Route::get('/invoice/search', [IncomeController::class, 'search'])->name('invoice.search');

// });

// Route::middleware('auth')->group(function () {
//     Route::get('/expense', [ExpenseController::class, 'index'])->name('expenseindex');
//     Route::post('/expense/submit', [ExpenseController::class, 'store'])->name('expensestore');
//     Route::get('/show/expense', [ExpenseController::class, 'show'])->name('expenseshow');
//     Route::get('/expense/edit/{id}', [ExpenseController::class, 'edit'])->name('expenseedit');
//     Route::post('/expense/update', [ExpenseController::class, 'update'])->name('expenseupdate');
//     Route::get('/delete/{id}', [ExpenseController::class, 'destroy'])->name('expensedestroy');
// });



Route::middleware('auth')->group(function () {
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/invoice/create/{id}', [InvoiceController::class, 'index'])->name('invoice.index');
//     Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');

//  });


Route::middleware('auth')->group(function () {
Route::get('/backup', [BackupController::class, 'createBackup'])->name('backup.create');

});






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

