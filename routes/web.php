<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingsController;

Route::get('/dashboard', function () {
    return view('layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/client', [ClientController::class, 'index'])->name('index');
    Route::post('/client/submit', [ClientController::class, 'create'])->name('create');
    Route::get('/show/client', [ClientController::class, 'show']) -> name('show');
    Route::get('/edit/client/{id}', [ClientController::class, 'edit']);
    Route::post('/client/update', [ClientController::class, 'update']);
    Route::get('/delete/{id}', [ClientController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/project', [ProjectController::class, 'index'])->name('index');
    Route::post('/project/submit', [ProjectController::class, 'store'])->name('store');
    Route::get('/show/project', [ProjectController::class, 'projectshow'])->name('projectshow');
    Route::get('/edit/project/{id}', [ProjectController::class, 'projectedit'])->name('projectedit');
    Route::post('/project/update', [ProjectController::class, 'projectupdate'])->name('projectupdate');
    Route::post('/delete/{id}', [ProjectController::class, 'projectdestroy'])->name('projectdestroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/income', [IncomeController::class, 'incomeindex'])->name('incomeindex');
    Route::post('/income/submit', [IncomeController::class, 'incomestore'])->name('incomestore');
    Route::get('/show/income', [IncomeController::class, 'incomeshow'])->name('incomeshow');
    Route::get('/income/edit/{id}', [IncomeController::class, 'edit'])->name('incomeedit');
    Route::post('/income/update', [IncomeController::class, 'update'])->name('incomeupdate');
    Route::get('/invoice/filter', [IncomeController::class, 'filter'])->name('invoice.filter');
    Route::delete('/income/delete/{id}', [IncomeController::class, 'destroy'])->name('income.delete');
    Route::get('/invoice/search', [IncomeController::class, 'search'])->name('invoice.search');

});

Route::middleware('auth')->group(function () {
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expenseindex');
    Route::post('/expense/submit', [ExpenseController::class, 'store'])->name('expensestore');
    Route::get('/show/expense', [ExpenseController::class, 'show'])->name('expenseshow');
    Route::get('/expense/edit/{id}', [ExpenseController::class, 'edit'])->name('expenseedit');
    Route::post('/expense/update', [ExpenseController::class, 'update'])->name('expenseupdate');
    Route::get('/delete/{id}', [ExpenseController::class, 'destroy'])->name('expensedestroy');
});



Route::middleware('auth')->group(function () {
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});


Route::middleware('auth')->group(function () {
    Route::get('/invoice/create/{id}', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');

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

