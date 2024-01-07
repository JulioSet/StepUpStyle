<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReturController;
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

    Route::prefix('ukuran')->group(function () {
    // UKURAN
        Route::get('/', [PageController::class, 'viewAdminUkuran']);
        Route::get('/add', [PageController::class, 'viewAdminAddUkuran']);
        Route::post('/add', [AdminController::class, 'addUkuran'])->name('Useraddukuran');
        Route::get('/edit/{id}', [PageController::class, 'viewAdminEditUkuran'])->name('viewEditUkuran');
        Route::post('/edit/{id}', [AdminController::class, 'EditUkuran'])->name('AdminEditukuran');
        Route::get('/unavailable/{id}', [AdminController::class, 'unavailableUkuran']);
        Route::get('/available/{id}', [AdminController::class, 'availableUkuran']);
    });

    Route::prefix('kategori')->group(function () {
    // KATEGIRI
        Route::get('/', [PageController::class, 'viewAdminKategori']);
        Route::get('/add', [PageController::class, 'viewAdminAddKategori']);
        Route::post('/add', [AdminController::class, 'addKategori'])->name('addKategori');
        Route::get('/edit/{id}', [PageController::class, 'viewAdminEditKategori'])->name('viewEditKategori');
        Route::post('/edit/{id}', [AdminController::class, 'EditKategori'])->name('AdminEditkategori');
        Route::get('/unavailable/{id}', [AdminController::class, 'unavailableKategori']);
        Route::get('/available/{id}', [AdminController::class, 'availableKategori']);
    });

    Route::prefix('supplier')->group(function () {
    // SUPPLIER
        Route::get('/', [PageController::class, 'viewAdminSupplier']);
        Route::get('/add', [PageController::class, 'viewAdminAddSupplier']);
        Route::post('/add', [AdminController::class, 'addSupplier'])->name('addSupplier');
        Route::get('/edit/{id}', [PageController::class, 'viewAdminEditSupplier'])->name('viewEditSupplier');
        Route::post('/edit/{id}', [AdminController::class, 'EditSupplier'])->name('AdminEditsupplier');
        Route::get('/delete/{id}', [AdminController::class, 'deleteSupplier']);
    });

    Route::prefix('retur')->group(function () {
    // RETUR
        Route::get('/', [PageController::class, 'viewAdminRetur']);
        Route::get('/reject/{id}', [AdminController::class, 'rejectRetur']);
        Route::get('/accept/{id}', [AdminController::class, 'acceptRetur']);
        Route::get('/cancel/{id}', [AdminController::class, 'cancelRetur']);
    });

    Route::prefix('product')->group(function () {
    // PRODUCT
        Route::get('/', [PageController::class, 'viewAdminProduct']);
        Route::get('/add', [PageController::class, 'viewAdminAddProduct']);
        Route::post('/add', [AdminController::class, 'addSepatu'])->name('addSepatu');
        Route::get('/edit/{id}', [PageController::class, 'viewAdminEditProduct'])->name('viewEditProduct');
        Route::post('/edit/{id}', [AdminController::class, 'EditSepatu'])->name('AdminEditProduct');
        Route::get('/delete/{id}', [AdminController::class, 'deleteSepatu']);
    });


    Route::prefix('user')->group(function () {
    // USER
        Route::get('/', [PageController::class, 'viewAdminUser']);
        Route::get('/add', [PageController::class, 'viewAdminAddUser']);
        Route::post('/add',[AdminController::class, 'addUser'])->name('Useraddadmin');
        Route::get('/edit/{id}', [PageController::class, 'viewAdminEditUser'])->name('viewEditUser');
        Route::post('/edit/{id}', [AdminController::class, 'Edituser'])->name('AdminEditUser');
        Route::get('/ban/{id}',[AdminController::class, 'banUser']);
        Route::get('/unban/{id}',[AdminController::class, 'unbanUser']);
    });
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
    Route::get('/{id}', [PageController::class, 'viewDetailProduct'])->name('product-detail');
    Route::get('/new-arrival', [PageController::class, 'viewNewArrival']);
    Route::get('/best-seller', [PageController::class, 'viewBestSeller']);
    Route::get('/brand/{id}', [PageController::class, 'viewBrandProducts']);
    Route::get('/category/{id}', [PageController::class, 'viewCategoryProducts']);
    // Route::get('/flashsale', [PageController::class, 'viewFlashSale'])->name('flashsale');
    // Route::get('/flashsale/{id}', [PageController::class, 'viewDetailRetur'])->name('product-retur');
});

Route::prefix('flashsale')->group(function () {
    Route::get('/', [PageController::class, 'viewFlashSale'])->name('flashsale');
    Route::get('/{id?}', [PageController::class, 'viewDetailRetur'])->name('product-retur');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [PageController::class, 'viewCart']);
    Route::get('/add/{id}/{qty?}', [CartController::class, 'addToCart'])->name("add-to-cart");
    Route::get('/up/{id}', [CartController::class, 'addQty'])->name("increase-cart-qty");
    Route::get('/down/{id}', [CartController::class, 'substractQty'])->name("reduced-cart-qty");
});

// Route::get('/checkout', [PageController::class, 'viewCheckout']); // nampilin halaman payment
// Route::post('/checkout', [PageController::class, 'viewCheckout']);
Route::prefix('checkout')->group(function () {
    Route::post('/', [PaymentController::class, 'process'])->name("checkout-process");
    Route::get('/product/{id}', [PaymentController::class, 'directProcess'])->name('checkout-product');
    Route::get('/{transaction}', [PaymentController::class, 'checkout'])->name("checkout");
    Route::get('/success/{transaction}', [PaymentController::class, 'success'])->name("checkout-success");
    Route::get('/cancel/{transaction}', [PaymentController::class, 'cancel'])->name("checkout-cancel");
    Route::get('/details/{transaction}', [PaymentController::class, 'details'])->name("checkout-details");

    Route::get('/retur/{retur_id}', [PaymentController::class, 'directProcess2'])->name("checkout-product-retur");

});

Route::prefix('retur')->group(function () {
    Route::get('/apply/{dtrans_id}', [PageController::class, 'viewFormRetur'])->name('form-retur');
    Route::get('/cancel/{retur_id}', [ReturController::class, 'cancelRetur'])->name('cancel-retur');
    Route::get('/details/{retur_id}', [ReturController::class, 'detailsRetur'])->name('details-retur');
    Route::post('/submit', [ReturController::class, 'retur'])->name('submit-retur');
});

Route::post('/search', [PageController::class, 'search']);


// user login, register, logout, profile edit
Route::post('login', [UserController::class, 'login'])->name('user-login');
Route::post('register', [UserController::class, 'register'])->name('user-register');
Route::get('logout', [UserController::class, 'logout'])->name('user-logout');
Route::post('profile', [UserController::class, 'editProfile'])->name('user-edit');
