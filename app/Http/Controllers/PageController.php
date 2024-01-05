<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\notifikasi;
use App\Models\retur;
use App\Models\sepatu;
use App\Models\supplier;
use App\Models\ukuran;
use App\Models\user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

// Mengatur perpindahan halaman
class PageController extends Controller
{
    // USER

    public function viewHome(){
        //pengecekan Auth User
        return view('home');
    }

    public function viewLogin(){
        //pengecekan Auth User
        return view('login');
    }

    public function viewRegister(){
        //pengecekan Auth User
        return view('register');
    }

    public function viewContact(){
        //pengecekan Auth User
        return view('contact');
    }

    public function viewAllProducts(){
        //select DB
        $page = "All Products";
        return view('products', compact('page'));
    }

    public function viewDetailProduct(Request $request){
        //select DB
        $page = "Detail Products";
        $listSepatu = sepatu::all();
        $id = $request->id;
        foreach ($listSepatu as $key => $f) {
            if ($f->sepatu_id == $id) {
                $sepatu = [
                    "id" => $f->sepatu_id,
                    "supplier" => $f->sepatu_supplier_id,
                    "kategori" => $f->sepatu_kategori_id,
                    "ukuran" => $f->sepatu_ukuran_id,
                    "picture" => $f->sepatu_pict,
                    "name" => $f->sepatu_name,
                    "stock" => $f->sepatu_stock,
                    "price" => $f->sepatu_price,
                    "color" => $f->sepatu_color,
                ];
            }
        }
        
        return view('productDetail', ["sepatu" => $sepatu]);
    }

    public function viewNewArrival(){
        //select DB
        $page = "New Arrival";
        return view('products', compact('page'));
    }

    public function viewBestSeller(){
        //select DB
        $page = "Best Seller";
        return view('products', compact('page'));
    }

    public function viewFlashSale(){
        //select DB
        $page = "Flash Sale";
        return view('products', compact('page'));
    }

    public function viewCart(){
        //pengecekan Auth User
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true) ?? [];
        return view('cart', compact('cartSepatu'));
    }

    // public function viewCheckout(){
    //     //pengecekan Auth User
    //     $userLoggedIn = Session::get('userLoggedIn');
    //     $cartSepatu = json_decode(Cookie::get('cartSepatu'), true) ?? [];
    //     return view('checkout', compact('cartSepatu', 'userLoggedIn'));
    // }

    // public function viewCart(){
    //     //pengecekan Auth User
    //     $cartSepatu = json_decode(Cookie::get('cartSepatu'), true) ?? [];
    //     return view('cart', compact('cartSepatu'));
    // }

    public function viewOrders(){
        //pengecekan Auth User
        $userLoggedIn = Session::get('userLoggedIn');
        $orders = user::find($userLoggedIn['id'])->orders()->orderBy('created_at', 'DESC')->get();
        return view('history', compact('orders'));
    }

    public function viewProfile(){
        //pengecekan Auth User
        return view('profile');
    }

    public function viewCategory(){
        //pengecekan Auth User
        return view('category');
    }


    // ADMIN

    public function viewAdminNotif()
    {
        $list = notifikasi::all();
        $modified = array();
        foreach ($list as $notif) {
            $modified[] = [
                'content' => $notif->notifikasi_content,
                'diff' => Carbon::parse($notif->created_at)->diffForHumans()
            ];
        }
        return view('admin.notifikasi.adminnotif', ['listnotif'=>$modified]);
    }



    function viewAdminUser() {
        return view('admin.user.adminuser',['listuser'=>user::withTrashed()->get()]);
    }
    function viewAdminAddUser(){
        return view('admin.user.adminadduser');
    }
    function viewAdminEditUser(Request $request){
        return view('admin.user.adminedituser',['IdUser'=>user::find($request->id)]);
    }



    function viewAdminProduct(){
        return view('admin.product.adminproduct',['listproduk'=>sepatu::all()]);
    }
    function viewAdminAddProduct(){
        return view('admin.product.adminaddproduct' ,['listkategori'=>kategori::all(), 'listsupplier'=>supplier::all(), 'listukuran'=>ukuran::all()]);
    }

    function viewAdminEditProduct(Request $request){
        return view('admin.product.admineditproduct' ,['IdProduct'=>sepatu::find($request->id),'listkategori'=>kategori::all(), 'listsupplier'=>supplier::all(), 'listukuran'=>ukuran::all()]);
    }



    function viewAdminUkuran(){
        return view('admin.ukuran.adminukuran',['listukuran'=>ukuran::withTrashed()->get()]);
    }
    function viewAdminAddUkuran(){
        return view('admin.ukuran.adminaddukuran');
    }
    function viewAdminEditUkuran(Request $request){
        return view('admin.ukuran.admineditukuran',['IdUkuran'=>ukuran::find($request->id)]);
    }




    function viewAdminKategori(){

        return view('admin.kategori.adminkategori',['listkategori'=>kategori::withTrashed()->get()]);
    }
    function viewAdminAddKategori(){

        return view('admin.kategori.adminaddkategori');
    }
    function viewAdminEditKategori(Request $request){
        return view('admin.kategori.admineditkategori',['IdKategori'=>kategori::find($request->id)]);
    }


    function viewAdminSupplier(){

        return view('admin.supplier.adminsupplier',['listsupplier'=>supplier::all()]);
    }
    function viewAdminAddSupplier(){

        return view('admin.supplier.adminaddsupplier');
    }
    function viewAdminEditSupplier(Request $request){
        return view('admin.supplier.admineditsupplier',['IdSupplier'=>supplier::find($request->id)]);
    }


    function viewAdminRetur(){

        return view('admin.retur.adminretur',['listretur'=>retur::all()]);
    }
}
