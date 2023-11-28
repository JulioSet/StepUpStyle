<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Mengatur perpindahan halaman
class PageController extends Controller
{
    public function viewHome(){
        //pengecekan Auth User
        return view('home');
    }

    public function viewLogin(){
        //pengecekan Auth User
        return view('login');
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
}
