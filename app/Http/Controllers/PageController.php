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
        return view('products');
    }

    public function viewNewArrival(){
        //select DB
        return view('products');
    }

    public function viewOrders(){
        //pengecekan Auth User
        return view('tracking');
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
    function viewAdminProduct(){
        return view('admin.product.adminproduct',['listproduk'=>sepatu::all()]);
    }
    function viewAdminAddProduct(){
        return view('admin.product.adminaddproduct' ,['listkategori'=>kategori::all(), 'listsupplier'=>supplier::all()]);
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
    function viewAdminEditUser(Request $request){
        return view('admin.user.adminedituser',['IdUser'=>user::find($request->id)]);
    }



    function viewAdminKategori(){

        return view('admin.kategori.adminkategori',['listkategori'=>kategori::withTrashed()->get()]);
    }
    function viewAdminAddKategori(){

        return view('admin.kategori.adminaddkategori');
    }



    function viewAdminSupplier(){

        return view('admin.supplier.adminsupplier',['listsupplier'=>supplier::all()]);
    }
    function viewAdminAddSupplier(){

        return view('admin.supplier.adminaddsupplier');
    }



    function viewAdminRetur(){

        return view('admin.retur.adminretur',['listretur'=>retur::all()]);
    }
}
