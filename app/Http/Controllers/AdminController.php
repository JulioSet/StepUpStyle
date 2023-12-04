<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           USER
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //Admin Nge ADD USER
    public function add (Request $request){
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
}
