<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\htrans;
use App\Models\kategori;
use App\Models\retur;
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

        $rules = [
            'nama' => ["required", "min:1",'unique:user,user_name'],
            'password' => 'required',
            // 'password_confirmation' => 'required',
            'email' => ["required", "email"]
        ];
        $messages = [
            "required" => "Please fill this field",
            "confirmed" => "Confirm Password does not match",
            "unique" => "The Username has already been taken"
        ];

        $request->validate($rules, $messages);


        $namaFolderPhoto = ""; $namaFilePhoto = "";
        if ($request->foto!=null) {
            foreach ($request->foto as $photo) {
                $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
                $namaFolderPhoto = "photo/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
            }
        }

        $user= new user();
        $user->user_name = $request->input('nama');
        $user->user_email = $request->input('email');
        $user->user_password = $request->input('password');
        $user->user_profile = $namaFilePhoto;
        $user->user_role = "customer";
        $user->verification = "special";
        $user->save();

        return redirect("/admin/user");
    }


    public function EditUser (Request $request){

        $rules = [
            'nama' => ["required", "min:1",'unique:user,user_name'],
            'password' => 'required',
            // 'password_confirmation' => 'required',
            'email' => ["required", "email"]
        ];
        $messages = [
            "required" => "Please fill this field",
            "confirmed" => "Confirm Password does not match",
            "unique" => "The Username has already been taken"
        ];

        $request->validate($rules, $messages);

        $namaFolderPhoto = ""; $namaFilePhoto = "";
        if ($request->foto!=null) {
            foreach ($request->foto as $photo) {
                $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
                $namaFolderPhoto = "photo/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
            }
        }

        $user= user::find($request->id);
        $user->user_name = $request->input('nama');
        $user->user_email = $request->input('email');
        $user->user_password= $request->input('password');
        $user->user_profile= $namaFilePhoto;
        $user->save();

        return redirect("/admin/user");
    }

    public function banUser ($id){
        $user = user::find($id);
        $user->delete();
        return redirect("/admin/user");
    }

    public function unbanUser ($id){
        $user = user::withTrashed()->find($id);
        $user->restore();
        return redirect("/admin/user");
    }

     //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           UKURAN
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function addUkuran (Request $request){
        $rules = [
            'ukuran' => ["required", "numeric","integer"],
        ];
        $messages = [
            "required" => "Please fill this field",
            "numeric" => "Value Must Number",
            "integer" => "Value Must Number"
        ];

        $request->validate($rules, $messages);

        $ukuran= new ukuran();
        $ukuran->ukuran_sepatu_nama = $request->input('ukuran');
        $ukuran->save();

        return redirect("/admin/ukuran");
    }


    public function EditUkuran (Request $request){
        $rules = [
            'ukuran' => ["required", "numeric","integer"],
        ];
        $messages = [
            "required" => "Please fill this field",
            "numeric" => "Value Must Integer",
            "integer" => "Value Must Integer"
        ];

        $request->validate($rules, $messages);

        $ukuran= ukuran::find($request->id);
        $ukuran->ukuran_sepatu_nama = $request->input('ukuran');
        $ukuran->save();

        return redirect("/admin/ukuran");
    }

    public function unavailableUkuran($id)
    {
        $ukuran = ukuran::find($id);
        $ukuran->delete();
        return redirect('/admin/ukuran');
    }

    public function availableUkuran($id)
    {
        $ukuran = ukuran::withTrashed()->find($id);
        $ukuran->restore();
        return redirect('/admin/ukuran');
    }


  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           SUPPLIER
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    public function addSupplier (Request $request){
        $rules = [
            'nama_supplier' => ["required", "min:1",'unique:supplier,supplier_name'],
            'supplier_contact' => 'required',
            'supplier_office' => 'required',
        ];
        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken"
        ];

        $request->validate($rules, $messages);

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

    public function EditSupplier (Request $request){
        $rules = [
            'nama_supplier' => ["required", "min:1",'unique:supplier,supplier_name'],
            'supplier_contact' => 'required',
            'supplier_office' => 'required',
        ];
        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken"
        ];

        $request->validate($rules, $messages);

        $namaFolderPhoto = ""; $namaFilePhoto = "";

        foreach ($request->foto as $photo) {
            $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
            $namaFolderPhoto = "photo/";

        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
        }



        $supplier= supplier::find($request->id);
        $supplier->supplier_name= $request->input('nama_supplier');
        $supplier->supplier_contact=$request->input('supplier_contact');
        $supplier->supplier_office=$request->input('supplier_office');
        $supplier->supplier_logo=$namaFilePhoto;
        $supplier->save();

        return redirect("/admin/supplier");
    }
    public function deleteSupplier($id)
    {
        $supplier = supplier::find($id);
        $supplier->delete();
        return redirect('/admin/supplier');
    }


  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           KATEGORI
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    public function addKategori (Request $request){
        $rules = [
            'nama_kategori' => ["required", "min:1",'unique:kategori,kategori_nama'],
        ];
        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken"
        ];

        $request->validate($rules, $messages);

        $kategori= new kategori();
        $kategori->kategori_nama= $request->input('nama_kategori');
        $kategori->save();

        return redirect("/admin/kategori");
    }

    public function EditKategori (Request $request){
        $rules = [
            'nama_kategori' => ["required", "min:1",'unique:kategori,kategori_nama'],
        ];
        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken"
        ];

        $request->validate($rules, $messages);

        $kategori= kategori::find($request->id);
        $kategori->kategori_nama= $request->input('nama_kategori');
        $kategori->save();

        return redirect("/admin/kategori");
    }

    public function unavailableKategori($id)
    {
        $kategori = kategori::find($id);
        $kategori->delete();
        return redirect('/admin/kategori');
    }

    public function availableKategori($id)
    {
        $kategori = kategori::withTrashed()->find($id);
        $kategori->restore();
        return redirect('/admin/kategori');
    }

  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           SEPATU
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    public function addSepatu (Request $request){
        $kategori = Kategori::where('kategori_nama', $request->input('kategori'))->first();
        $supplier = supplier::where('supplier_name',$request->input('brand'))->first();
        $ukuran = ukuran::where('ukuran_sepatu_nama',$request->input('ukuran'))->first();

        $kategoriID=$kategori->kategori_id;
        $supplierID=$supplier->supplier_id;
        $ukuranID=$ukuran->ukuran_sepatu_id;

        $namaFolderPhoto = ""; $namaFilePhoto = "";
        if ($request->foto!=null) {
            foreach ($request->foto as $photo) {
                $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
                $namaFolderPhoto = "photo/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
            }
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



    public function EditSepatu (Request $request){
        $kategori = Kategori::where('kategori_nama', $request->input('kategori'))->first();
        $supplier = supplier::where('supplier_name',$request->input('brand'))->first();
        $ukuran = ukuran::where('ukuran_sepatu_nama',$request->input('ukuran'))->first();

        $kategoriID=$kategori->kategori_id;
        $supplierID=$supplier->supplier_id;
        $ukuranID=$ukuran->ukuran_sepatu_id;

        $namaFolderPhoto = ""; $namaFilePhoto = "";
        if ($request->foto!=null) {
            foreach ($request->foto as $photo) {
                $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
                $namaFolderPhoto = "photo/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
            }
    }

        $sepatu= sepatu::find($request->id);
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
    public function deleteSepatu($id)
    {
        $sepatu = sepatu::find($id);
        $sepatu->delete();
        return redirect('/admin/product');
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           RETUR
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function acceptRetur($id)
    {
        $retur = retur::find($id);
        $retur->retur_status = 1;
        $retur->save();

        return redirect("/admin/retur");
    }

    public function rejectRetur($id)
    {
        $retur = retur::find($id);
        $retur->retur_status = 0;
        $retur->save();

        return redirect("/admin/retur");
    }

    // public function cancelRetur($id)
    // {
    //     $retur = retur::find($id);
    //     $retur->retur_status = 9;
    //     $retur->save();

    //     return redirect("/admin/retur");
    // }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //                                                           ORDER
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function markAsDoneOrder($id)
    {
        $order = htrans::find($id);
        $order->htrans_penjualan_status = 3;
        $order->save();
        return redirect('admin/order');
    }
}
