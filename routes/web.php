<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
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
    return view('login');
});


// /adminproduct

Route::get('/adminukuran', [PageController::class, 'viewAdminUkuran']);
Route::get('/adminaddukuran', [PageController::class, 'viewAdminAddUkuran']);
Route::post('/adminaddukuran', [AdminController::class, 'addUkuran'])->name('Useraddukuran');
Route::get('/admineditukuran/{id}', [PageController::class, 'viewAdminEditUkuran'])->name('viewEditUkuran');
Route::post('/admineditukuran/{id}', [AdminController::class, 'EditUkuran'])->name('AdminEditukuran');


Route::get('/adminproduct', [PageController::class, 'viewAdminProduct']);
Route::get('/adminaddproduct', [PageController::class, 'viewAdminAddProduct']);

Route::get('/adminuser', [PageController::class, 'viewAdminUser']);
Route::get('/adminadduser', [PageController::class, 'viewAdminAddUser']);
Route::post('/adminadduser',[AdminController::class, 'addUser'])->name('Useraddadmin');

Route::get('/login', [PageController::class, 'viewLogin']);
Route::post('/login', [PageController::class, 'login']);

Route::get('/', [PageController::class, 'viewHome']);
Route::get('/contact', [PageController::class, 'viewContact']);
Route::prefix('products')->group(function () {
    Route::get('/', [PageController::class, 'viewAllProducts']);
    Route::get('/new-arrival', [PageController::class, 'viewNewArrival']);
    Route::get('/best-seller', [PageController::class, 'viewBestSeller']);
    Route::get('/flash-sale', [PageController::class, 'viewFlashSale']);
});
Route::get('/cart', [PageController::class, 'viewCart']);
Route::post('/search', [PageController::class, 'search']);

