<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ukuran;
use App\Models\user;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           USER
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //Admin Nge ADD USER
    public function addUser (Request $request){
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($request->foto as $photo) {
            $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
            $namaFolderPhoto = "photo/";

        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        $role="customer";
        if ($request->input('admin')) {
            $role="admin";
        }
        elseif ($request->input('customer')) 
        {
            $role="customer";
        }
        

        $user= new user();
        $user->user_name = $request->input('nama');
        $user->user_email = $request->input('email');
        $user->user_password= $request->input('password');
        $user->user_profile= $namaFilePhoto;
        $user->user_role="admin";
        $user->save();

        return redirect("/adminuser");
    }

    public function addUkuran (Request $request){
        

        $ukuran= new ukuran();
        $ukuran->ukuran_sepatu_nama = $request->input('ukuran');
        $ukuran->ukuran_sepatu_stock = $request->input('stock');
        $ukuran->save();

        return redirect("/adminukuran");
    }


    public function EditUkuran (Request $request){

        $ukuran= ukuran::find($request->id);
        $ukuran->ukuran_sepatu_nama = $request->input('ukuran');
        $ukuran->ukuran_sepatu_stock = $request->input('stock');
        $ukuran->save();

        return redirect("/adminukuran");
    }
}
