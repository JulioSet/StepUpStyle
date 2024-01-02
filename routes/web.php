<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    if (Session::get('userLoggedIn') == null) {
        return redirect('/login');
    }
    return redirect('/home');
});

Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/payment/notification', [PaymentController::class, 'notification']);

Route::prefix('admin')->group(function () {
    // NOTIFIKASI
    Route::get('/', [PageController::class, 'viewAdminNotif']);

    // UKURAN
    Route::get('/ukuran', [PageController::class, 'viewAdminUkuran']);
    Route::get('/addukuran', [PageController::class, 'viewAdminAddUkuran']);
    Route::post('/addukuran', [AdminController::class, 'addUkuran'])->name('Useraddukuran');
    Route::get('/ukuran/edit/{id}', [PageController::class, 'viewAdminEditUkuran'])->name('viewEditUkuran');
    Route::post('/ukuran/edit/{id}', [AdminController::class, 'EditUkuran'])->name('AdminEditukuran');
    Route::get('/ukuran/unavailable/{id}', [AdminController::class, 'unavailableUkuran']);
    Route::get('/ukuran/available/{id}', [AdminController::class, 'availableUkuran']);

    // KATEGIRI
    Route::get('/kategori', [PageController::class, 'viewAdminKategori']);
    Route::get('/addkategori', [PageController::class, 'viewAdminAddKategori']);
    Route::post('/addkategori', [AdminController::class, 'addKategori'])->name('addKategori');
    Route::get('/kategori/edit/{id}', [PageController::class, 'viewAdminEditKategori'])->name('viewEditKategori');
    Route::post('/kategori/edit/{id}', [AdminController::class, 'EditKategori'])->name('AdminEditkategori');
    Route::get('/kategori/unavailable/{id}', [AdminController::class, 'unavailableKategori']);
    Route::get('/kategori/available/{id}', [AdminController::class, 'availableKategori']);

    // SUPPLIER
    Route::get('/supplier', [PageController::class, 'viewAdminSupplier']);
    Route::get('/addsupplier', [PageController::class, 'viewAdminAddSupplier']);
    Route::post('/addsupplier', [AdminController::class, 'addSupplier'])->name('addSupplier');
    Route::get('/supplier/edit/{id}', [PageController::class, 'viewAdminEditSupplier'])->name('viewEditSupplier');
    Route::post('/supplier/edit/{id}', [AdminController::class, 'EditSupplier'])->name('AdminEditsupplier');
    Route::get('/supplier/delete/{id}', [AdminController::class, 'deleteSupplier']);

    // RETUR
    Route::get('/retur', [PageController::class, 'viewAdminRetur']);
    Route::get('/retur/reject/{id}', [AdminController::class, 'rejectRetur']);
    Route::get('/retur/accept/{id}', [AdminController::class, 'acceptRetur']);
    Route::get('/retur/cancel/{id}', [AdminController::class, 'cancelRetur']);

    // PRODUCT
    Route::get('/product', [PageController::class, 'viewAdminProduct']);
    Route::get('/addproduct', [PageController::class, 'viewAdminAddProduct']);
    Route::post('/addproduct', [AdminController::class, 'addSepatu'])->name('addSepatu');
    Route::get('/product/delete/{id}', [AdminController::class, 'deleteSepatu']);

    // USER
    Route::get('/user', [PageController::class, 'viewAdminUser']);
    Route::get('/adduser', [PageController::class, 'viewAdminAddUser'])->name('viewEditUser');
    Route::post('/adduser',[AdminController::class, 'addUser'])->name('Useraddadmin');
    Route::get('/user/ban/{id}',[AdminController::class, 'banUser']);
    Route::get('/user/unban/{id}',[AdminController::class, 'unbanUser']);
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

Route::prefix('cart')->group(function () {
    Route::get('/', [PageController::class, 'viewCart']);
    Route::get('/add/{id}', [CartController::class, 'addToCart']);
    Route::get('/up/{id}', [CartController::class, 'addQty']);
    Route::get('/down/{id}', [CartController::class, 'substractQty']);
});

Route::post('/search', [PageController::class, 'search']);


// user login, register, logout, profile edit
Route::post('login', [UserController::class, 'login'])->name('user-login');
Route::post('register', [UserController::class, 'register'])->name('user-register');
Route::get('logout', [UserController::class, 'logout'])->name('user-logout');
Route::post('profile', [UserController::class, 'editProfile'])->name('user-edit');
