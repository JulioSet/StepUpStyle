<?php

namespace App\Http\Controllers;

use App\Models\ukuran;
use App\Models\user;
use Illuminate\Http\Request;

// Mengatur perpindahan halaman
class PageController extends Controller
{
    //user

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


    // admin

    function viewAdminUser() {
        user::all();
        return view('admin.user.adminuser',['listuser'=>user::all()]);
    }

    function viewAdminAddUser(){
        return view('admin.user.adminadduser');
    }

    function viewAdminProduct(){
        return view('admin.product.adminproduct');
    }

    function viewAdminAddProduct(){
        return view('admin.product.adminaddproduct');
    }

    function viewAdminUkuran(){

        return view('admin.ukuran.adminukuran',['listukuran'=>ukuran::all()]);
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
    
    
}
