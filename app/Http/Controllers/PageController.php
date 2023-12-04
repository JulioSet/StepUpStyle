<?php

namespace App\Http\Controllers;

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



    // admin

    function viewAdminUser() {
        user::all();
        return view('admin.adminuser',['listuser'=>user::all()]);
    }

    function viewAdminAddUser(){
        return view('admin.adminadduser');
    }

    function viewAdminProduct(){
        return view('admin.adminproduct');
    }

    function viewAdminAddProduct(){
        return view('admin.adminaddproduct');
    }
    
}
