<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionsController;
use App\Models\Invoices;
use App\Models\invoices_details;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //welcome,register
    return view('auth.login');
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
Route::middleware('auth')->group(function () {
    Route::resource('invoices',InvoicesController::class);
    Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
    Route::get('/invoice_details/{id}', [InvoicesController::class, 'edit']);
    Route::get('/View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);
    Route::get('/download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);    
    Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])/*->name('delete_file')*/;   
    Route::resource('sections',SectionsController::class);
    Route::resource('products',ProductsController::class);

    Route::get('/{page}',[AdminController::class,'index']);
});
// Route::resource('invoices',InvoicesController::class);
// Route::resource('sections',SectionsController::class);
// Route::resource('products',ProductsController::class);


