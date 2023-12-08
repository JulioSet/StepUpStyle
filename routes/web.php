<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
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

Route::prefix('admin')->group(function () {
    Route::get('/ukuran', [PageController::class, 'viewAdminUkuran']);
    Route::get('/addukuran', [PageController::class, 'viewAdminAddUkuran']);
    Route::post('/addukuran', [AdminController::class, 'addUkuran'])->name('Useraddukuran');
    Route::get('/editukuran/{id}', [PageController::class, 'viewAdminEditUkuran'])->name('viewEditUkuran');
    Route::post('/editukuran/{id}', [AdminController::class, 'EditUkuran'])->name('AdminEditukuran');


    Route::get('/kategori', [PageController::class, 'viewAdminKategori']);
    Route::get('/addkategori', [PageController::class, 'viewAdminAddKategori']);
    Route::post('/addkategori', [AdminController::class, 'addKategori'])->name('addKategori');

    Route::get('/supplier', [PageController::class, 'viewAdminSupplier']);
    Route::get('/addsupplier', [PageController::class, 'viewAdminAddSupplier']);
    Route::post('/addsupplier', [AdminController::class, 'addSupplier'])->name('addSupplier');



    Route::get('/retur', [PageController::class, 'viewAdminRetur']);
    


    Route::get('/product', [PageController::class, 'viewAdminProduct']);
    Route::get('/addproduct', [PageController::class, 'viewAdminAddProduct']);
    Route::post('/addproduct', [AdminController::class, 'addSepatu'])->name('addSepatu');

    Route::get('/user', [PageController::class, 'viewAdminUser']);
    Route::get('/adduser', [PageController::class, 'viewAdminAddUser'])->name('viewEditUser');
    Route::post('/adduser',[AdminController::class, 'addUser'])->name('Useraddadmin');
});



Route::get('/login', [PageController::class, 'viewLogin']);
Route::get('/register', [PageController::class, 'viewRegister']);

Route::get('/orders', [PageController::class, 'viewOrders']);
Route::get('/profile', [PageController::class, 'viewProfile']);
Route::get('/category', [PageController::class, 'viewCategory']);

Route::get('/home', [PageController::class, 'viewHome'])->name('home');
Route::get('/contact', [PageController::class, 'viewContact']);
Route::prefix('products')->group(function () {
    Route::get('/', [PageController::class, 'viewAllProducts']);
    Route::get('/new-arrival', [PageController::class, 'viewNewArrival']);
    Route::get('/best-seller', [PageController::class, 'viewBestSeller']);
    Route::get('/flash-sale', [PageController::class, 'viewFlashSale']);
});
Route::get('/cart', [PageController::class, 'viewCart']);
Route::post('/search', [PageController::class, 'search']);


// user login, register & logout
Route::post('login', [UserController::class, 'login'])->name('user-login');
Route::post('register', [UserController::class, 'register'])->name('user-register');
Route::get('logout', [UserController::class, 'logout'])->name('user-logout');
