<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailSepatu;
use App\Models\htrans;
use App\Models\kategori;
use App\Models\retur;
use App\Models\sepatu;
use App\Models\SubKategori;
use App\Models\supplier;
use App\Models\ukuran;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
                if ($photo->getSize() > 5000000) {
                    return redirect()->back()->with('error', 'Ukuran foto terlalu besar. Maksimal ukuran adalah 5MB.');
                }
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
                if ($photo->getSize() > 5000000) {
                    return redirect()->back()->with('error', 'Ukuran foto terlalu besar. Maksimal ukuran adalah 5MB.');
                }
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
        if ($request->foto!=null) {
            foreach ($request->foto as $photo) {
                if ($photo->getSize() > 5000000) {
                    return redirect()->back()->with('error', 'Ukuran foto terlalu besar. Maksimal ukuran adalah 5MB.');
                }
                $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
                $namaFolderPhoto = "photo/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
            }
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
        if ($request->foto!=null) {
            foreach ($request->foto as $photo) {
                if ($photo->getSize() > 5000000) {
                    return redirect()->back()->with('error', 'Ukuran foto terlalu besar. Maksimal ukuran adalah 5MB.');
                }
                $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
                $namaFolderPhoto = "photo/";

            $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');
            }
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

    public function addVarianKategori (Request $request){
        $rules = [
            'sub_kategori' => ["required", "min:1",'unique:subkategori,subkategori_nama'],
        ];
        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken"
        ];
        $request->validate($rules, $messages);

        $subkategori= new SubKategori();
        $subkategori->fk_kategori= $request->id;
        $subkategori->subkategori_nama= $request->input('sub_kategori');
        $subkategori->save();

        return redirect()->route('viewAdminVarianKategori', ['id' => $request->id]);
    }

    public function EditSubKategori (Request $request){
        $rules = [
            'sub_kategori' => ["required", "min:1",'unique:subkategori,subkategori_nama'],
        ];
        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken"
        ];

        $request->validate($rules, $messages);

        $subkategori= SubKategori::find($request->sub);
        $subkategori->subkategori_nama= $request->input('sub_kategori');
        $subkategori->save();

        return redirect()->route('viewAdminVarianKategori', ['id' => $request->id]);
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
        $sepatu = new sepatu();
        $sepatu->sepatu_name=$request->input('namaSepatu');
        $sepatu->sepatu_supplier_id = $request->input('brand');
        $sepatu->sepatu_kategori_id = $request->input('kategori');
        $sepatu->sepatu_subkategori_id = $request->input('sub_kategori');
        $sepatu->save();

        return redirect("/admin/product");
    }

    public function addVarianSepatu (Request $request){
        $rules = [
            'foto' => ["required", "max:2048", "extensions:jpg,jpeg,png"],
            'warna' => 'required',
            'ukuran' => 'required',
            'stock' => 'required',
            'harga' => 'required',
        ];
        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken",
            "max" => "File size exceeds 2MB limit",
            "extensions" => "File is not jpg, jpeg, or png",
        ];

        $request->validate($rules, $messages);

        $photo = $request->foto;
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
        $namaFolderPhoto = "photo/";
        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');

        $varian = new DetailSepatu();
        $varian->fk_sepatu= $request->id;
        $varian->detail_sepatu_pict= $namaFilePhoto;
        $varian->detail_sepatu_warna=$request->input('warna');
        $varian->detail_sepatu_ukuran= $request->input('ukuran');
        $varian->detail_sepatu_stok=$request->input('stock');
        $varian->detail_sepatu_harga=str_replace(',','',$request->input('harga'));
        $varian->save();

        return redirect()->route('viewVarianProduct', ['id' => $request->id]);
    }

    public function EditSepatu (Request $request){
        $sepatu = sepatu::find($request->id);
        $sepatu->sepatu_name = $request->input('namaSepatu');
        $sepatu->sepatu_supplier_id = $request->input('brand');
        $sepatu->sepatu_kategori_id = $request->input('kategori');
        $sepatu->sepatu_subkategori_id = $request->input('sub_kategori');
        $sepatu->save();

        return redirect("/admin/product");
    }

    public function EditVarianSepatu (Request $request){
        $rules = [
            'foto' => ["required", "max:2048", "extensions:jpg,jpeg,png"],
            'warna' => 'required',
            'ukuran' => 'required',
            'stock' => 'required',
            'harga' => 'required',
        ];
        $messages = [
            "required" => "Please fill this field",
            "unique" => "The Name has already been taken",
            "max" => "File size exceeds 2MB limit",
            "extensions" => "File is not jpg, jpeg, or png",
        ];

        $request->validate($rules, $messages);

        $photo = $request->foto;
        $namaFolderPhoto = ""; $namaFilePhoto = "";
        $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
        $namaFolderPhoto = "photo/";
        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');

        $varian = DetailSepatu::find($request->id);
        $varian->detail_sepatu_pict = $namaFilePhoto;
        $varian->detail_sepatu_warna = $request->input('warna');
        $varian->detail_sepatu_ukuran= $request->input('ukuran');
        $varian->detail_sepatu_stok = $request->input('stock');
        $varian->detail_sepatu_harga = $request->input('harga');
        $varian->save();

        return redirect()->route('viewVarianProduct', ['id' => $request->id]);
    }

    public function deleteSepatu($id)
    {
        $sepatu = sepatu::find($id);
        $sepatu->delete();
        return redirect('/admin/product');
    }

    public function unavailableVarianSepatu($id, $sub)
    {
        $varian = DetailSepatu::find($sub);
        $varian->delete();
        return redirect()->route('viewVarianProduct', ['id' => $id]);
    }

    public function availableVarianSepatu($id, $sub)
    {
        $varian = DetailSepatu::withTrashed()->find($sub);
        $varian->restore();
        return redirect()->route('viewVarianProduct', ['id' => $id]);
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

    public function logout(Request $request)
    {
        Session::forget('AdminLoggedIn');
        return redirect()->route('login');
    }
}
