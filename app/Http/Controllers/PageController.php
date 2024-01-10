<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
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

    public function viewDetailRetur(Request $request, $id){
        //select DB
        $retur = retur::find($id);
        // dd($retur);
        $stock = retur::where('fk_sepatu','=',$retur->fk_sepatu)
                        ->where('retur_status','=',1)->count();
        $sepatu = [
            "id" => $retur->fk_sepatu,
            "supplier" => $retur->sepatu->sepatu_supplier_id,
            "kategori" => $retur->sepatu->sepatu_kategori_id,
            "ukuran" => $retur->sepatu->sepatu_ukuran_id,
            "picture" => $retur->retur_pict,
            "name" => $retur->sepatu->sepatu_name,
            "stock" => $stock,
            "price" => $retur->sepatu->sepatu_price,
            "color" => $retur->sepatu->sepatu_color,
        ];

        return view('product-retur-detail', ["sepatu" => $sepatu, "retur" => $retur]);
    }

    public function viewDetailProduct(Request $request){
        //select DB
        $page = "Detail Products";
        $listSepatu = sepatu::all();
        $id = $request->id;
        $sepatu = [];
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
        return view('products-new-arrival', compact('page'));
    }

    public function viewCategoryProducts(Request $request){
        //select DB
        $page = "Category";
        $id = $request->id;
        $listCategory = sepatu::where('sepatu_kategori_id','=',$id)->get();
        return view('products-category', compact('listCategory'));
    }

    public function viewBestSeller(){
        //select DB
        $page = "Best Seller";

        $bestSeller = dtrans::select('fk_sepatu')
        ->groupBy('fk_sepatu')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

        return view('products-best-seller', compact('bestSeller'));
    }

    public function viewBrandProducts(Request $request){
        //select DB
        $page = "Brand";
        $id = $request->id;
        $listBrand = sepatu::where('sepatu_supplier_id','=',$id)->get();

        return view('products-brand', compact('listBrand'));
    }

    public function viewSearchProducts(Request $request){
        //select DB
        $page = "Search";
        $search = $request->search;
        $listSearch = sepatu::where('sepatu_name',$request->search)
        ->orWhere('sepatu_name','like',"%{$request->search}%")
        ->get();;

        return view('products-search', compact('listSearch'));
    }

    public function viewFilteredProducts(Request $request){
        //select DB
        $page = "Filter";
        $filterBrand = $request->input('brand', []);
        $filterSize = $request->input('size', []);

        if ($filterBrand && $filterSize) {
            $listFilter = sepatu::whereIn('sepatu_supplier_id', $filterBrand)
            ->whereIn('sepatu_ukuran_id', $filterSize)
            ->where('deleted_at', null)
            ->where('sepatu_stock','>',0)
            ->get();
        }elseif ($filterBrand && !$filterSize) {
            $listFilter = sepatu::whereIn('sepatu_supplier_id', $filterBrand)
            ->where('deleted_at', null)
            ->where('sepatu_stock','>',0)
            ->get();
        }elseif (!$filterBrand && $filterSize) {
            $listFilter = sepatu::whereIn('sepatu_ukuran_id', $filterSize)
            ->where('deleted_at', null)
            ->where('sepatu_stock','>',0)
            ->get();
        }

        return view('products-filter', compact('listFilter'));
    }

    public function viewFlashSale(){
        $userLoggedIn = Session::get('userLoggedIn');
	    $listRetur = retur::where('retur_status','=',1)->get();
        // dd($listRetur);

        return view('products-flashsale', compact('listRetur'));
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

    public function viewFormRetur($dtrans_id){
        //pengecekan Auth User
        $userLoggedIn = Session::get('userLoggedIn');
        $product = dtrans::find($dtrans_id);
        Cookie::queue('tempRetur', json_encode($product), 1209600);
        // $tempRetur = json_decode(Cookie::get('tempRetur'), true);
        // dd($tempRetur);

        return view('retur-form', compact('userLoggedIn', 'product'));
    }

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
        return view('admin.user.adminuser',['listuser'=>user::withTrashed()->where('user_role', 'customer')->get()]);
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
        return view('admin.product.adminaddproduct' ,[
            'listkategori'=>kategori::all(),
            'listsupplier'=>supplier::all(),
            'listukuran'=>ukuran::all()
        ]);
    }
    function viewAdminEditProduct(Request $request){
        return view('admin.product.admineditproduct' ,[
            'IdProduct'=>sepatu::find($request->id),
            'listkategori'=>kategori::all(),
            'listsupplier'=>supplier::all(),
            'listukuran'=>ukuran::all()
        ]);
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


    function viewAdminOrder()
    {
        return view('admin.order.adminorder', ['listorder'=>htrans::where('htrans_penjualan_status', 2)->get()]);
    }
    function viewAdminDetailOrder($id)
    {
        return view('admin.order.adminDetailOrder', [
            "listdtrans"=>dtrans::where('fk_htrans_penjualan', $id)->get(),
            "listhtrans"=>htrans::where('htrans_penjualan_id', $id)->get()
        ]);
    }

    // OWNER

    function viewMasterAdmin(){
        return view('owner.ownerAdmin', ['listadmin' => user::where('user_role', 'admin')->get()]);
    }

    function viewLaporanPenjualan(){
        return view('owner.laporan.laporanpenjualan',['listhtrans' => htrans::where('htrans_penjualan_status', 2)->get()]);
    }
    function viewDetailLaporanPenjualan(Request $request){
        return view('owner.laporan.detailLaporanPenjualan',[
            "listdtrans"=>dtrans::where('fk_htrans_penjualan', $request->id)->get(),
            "listhtrans"=>htrans::where('htrans_penjualan_id', $request->id)->get()
        ]);
    }


    function viewLaporanRetur(){
        return view('owner.laporan.laporanretur',['listretur'=>retur::all()]);
    }


    function viewLaporanProduct(){
        return view('owner.Laporan.laporanProduct',['listproduct'=>sepatu::orderBy('sepatu_stock')->get()]);
    }
}
