<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use App\Models\sepatu;
use App\Models\supplier;
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

        $user= new user();
        $user->user_name = $request->input('nama');
        $user->user_email = $request->input('email');
        $user->user_password= $request->input('password');
        $user->user_profile= $namaFilePhoto;
        $user->user_role="admin";
        $user->save();

        return redirect("/admin/user");
    }


    public function EditUser (Request $request){


        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($request->foto as $photo) {
            $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
            $namaFolderPhoto = "photo/";

        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        $user= user::find($request->id);
        $user->user_name = $request->input('nama');
        $user->user_email = $request->input('email');
        $user->user_password= $request->input('password');
        $user->user_profile= $namaFilePhoto;
        $user->save();

        return redirect("/admin/user");
    }

    public function editUserStatus ($id){




        return redirect("/admin/user");
    }



     //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           UKURAN
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function addUkuran (Request $request){


        $ukuran= new ukuran();
        $ukuran->ukuran_sepatu_nama = $request->input('ukuran');
        $ukuran->save();

        return redirect("/admin/ukuran");
    }


    public function EditUkuran (Request $request){

        $ukuran= ukuran::find($request->id);
        $ukuran->ukuran_sepatu_nama = $request->input('ukuran');
        $ukuran->save();

        return redirect("/admin/ukuran");
    }


  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           SUPPLIER
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    public function addSupplier (Request $request){
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($request->foto as $photo) {
            $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
            $namaFolderPhoto = "photo/";

        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }


        $supplier= new supplier();
        $supplier->supplier_name= $request->input('nama_supplier');
        $supplier->supplier_contact=$request->input('supplier_contact');
        $supplier->supplier_office=$request->input('supplier_office');
        $supplier->supplier_logo=$namaFilePhoto;
        $supplier->save();

        return redirect("/admin/supplier");
    }


  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           KATEGORI
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    public function addKategori (Request $request){
        $kategori= new kategori();
        $kategori->kategori_nama= $request->input('nama_kategori');
        $kategori->save();

        return redirect("/admin/kategori");
    }


  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           SEPATU
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    public function addSepatu (Request $request){

        $kategori = Kategori::where('kategori_nama', $request->input('kategori'))->first();
        $supplier = supplier::where('supplier_name',$request->input('brand'))->first();
        $ukuran = ukuran::where('ukuran_sepatu_nama',29)->first();

        $kategoriID=$kategori->kategori_id;
        $supplierID=$supplier->supplier_id;
        $ukuranID=$ukuran->ukuran_sepatu_id;

        $namaFolderPhoto = ""; $namaFilePhoto = "";
        foreach ($request->foto as $photo) {
            $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
            $namaFolderPhoto = "photo/";

        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }

        $sepatu= new sepatu();
        $sepatu->sepatu_supplier_id= $supplierID;
        $sepatu->sepatu_kategori_id= $kategoriID;
        $sepatu->sepatu_ukuran_id= $ukuranID;
        $sepatu->sepatu_pict= $namaFilePhoto;
        $sepatu->sepatu_name=$request->input('namaSepatu');
        $sepatu->sepatu_stock=$request->input('stock');
        $sepatu->sepatu_price=$request->input('harga');
        $sepatu->sepatu_color=$request->input('warna');
        $sepatu->save();

        return redirect("/admin/product");
    }
}
