<?php

namespace App\Http\Controllers;

use App\Models\DetailSepatu;
use App\Models\dtrans;
use App\Models\htrans;
use App\Models\notifikasi;
use App\Models\retur;
use App\Models\sepatu;
use App\Services\RajaOngkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    // public function index()
    // {
    //     // Set up Midtrans configuration
    //     Config::$serverKey = config('services.midtrans.server_key');

    //     // Retrieve payment details from the request or database
    //     $order_id = uniqid();
    //     $amount = 10000; // Replace with the actual amount
    //     $customer_name = 'John Doe';
    //     $customer_email = 'john.doe@example.com';
    //     $customer_phone = '081234567890';

    //     // Set transaction details
    //     $transaction_details = [
    //         'order_id' => $order_id,
    //         'gross_amount' => $amount,
    //     ];

    //     // Set customer details
    //     $customer_details = [
    //         'first_name' => $customer_name,
    //         'email' => $customer_email,
    //         'phone' => $customer_phone,
    //     ];

    //     // Prepare transaction data
    //     $transaction_data = [
    //         'transaction_details' => $transaction_details,
    //         'customer_details' => $customer_details,
    //     ];


    //     // Create Snap Token
    //     try {
    //         $snapToken = Snap::getSnapToken($transaction_data);
    //     } catch (\Exception $e) {
    //         // Handle any errors that occur during token generation
    //         return redirect()->route('payment.error');

    //     }

    //     return view('payment.payment-page', compact('snapToken'));
    // }

    // public function notification(Request $request)
    // {
    //     $notification = json_decode($request->getContent(), true);

    //     // Process the notification and update your database accordingly

    //     return response(['status' => 'OK']);
    // }

    // ================= KALKULASI ONGKIR =================
    public function calculateCost($cityID) {
        $rajaOngkir = new RajaOngkir(config('rajaongkir.API'));
        $cost = $rajaOngkir->postCost($cityID);
        return response()->json($cost ?? []);
    }

    // ================= CART CHECKOUT (DARI CART) =================
    public function process2($product=null)
    {
        $cart = json_decode(Cookie::get('cartSepatu'), true); //cookie 14 hari
        $user = Session::get('userLoggedIn');
        $htrans_penjualan_id = rand(10000,99999);
        $cek = htrans::find($htrans_penjualan_id);
        while (!$cek->isEmpty()) {
            $htrans_penjualan_id = rand(10000,99999);
            $cek = htrans::find($htrans_penjualan_id);
        }

        $totalProducts = 0;

        if ($cart == null) {
            $cart = $product;
        }

        if ($cart == null) {
            return redirect('/orders');
        }

        $transaction = htrans::create([
            'htrans_penjualan_id' => $htrans_penjualan_id,
            'fk_customer' => $user['id'],
            'htrans_penjualan_status' => 1,
        ]);

        foreach ($cart as $c) {
            $sepatu = sepatu::find($c['detail_id']);
            $subtotal = $c['qty']*$sepatu->detail_sepatu_price;
            $dtrans = dtrans::create([
                'fk_htrans_penjualan' => $htrans_penjualan_id,
                'fk_detail_sepatu' => $c['detail_id'],
                'dtrans_penjualan_qty' => $c['qty'],
                'dtrans_penjualan_price' => $sepatu->detail_sepatu_price,
                'dtrans_penjualan_subtotal' => $subtotal
            ]);
            $sepatu->detail_sepatu_stok -= $c['qty'];
            $sepatu->save();
            $totalProducts += $subtotal;
        }

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $htrans_penjualan_id,
                'gross_amount' => $totalProducts
            ),
            'customer_details' => array(
                'name' => $user['name'],
                'email' => $user['email'],
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction = htrans::find($htrans_penjualan_id);
        $transaction->snap_token = $snapToken;
        $transaction->htrans_penjualan_total = $totalProducts;
        $transaction->save();

        return redirect()->route('checkout', $htrans_penjualan_id);
    }

    // ================= DIRECT CHECKOUT (DARI HALAMAN DETAIL PRODUCT) =================
    public function directProcess($sepatu_id, $detail_size, $detail_color, $qty)
    {
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true);

        if ($cartSepatu!=null) {
            $cartSepatu = [];
            Cookie::queue('cartSepatu', json_encode($cartSepatu), 1209600);
        }

        $detail_id = DetailSepatu::where('fk_sepatu','=',$sepatu_id)
            ->where('detail_sepatu_ukuran','=',$detail_size)
            ->where('detail_sepatu_warna','=',$detail_color)
            ->value('detail_sepatu_id');

        $sepatu = [
            "detail_id" => $detail_id,
            "qty" => $qty
        ];

        array_push($cartSepatu, $sepatu);

        Cookie::queue('cartSepatu', json_encode($cartSepatu));
        return $this->process($cartSepatu);
    }

    public function checkout(htrans $transaction, $product=null)
    {
        $userLoggedIn = Session::get('userLoggedIn');
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true) ?? [];
        $shipping_description = json_decode(Cookie::get('shipping-description'), true) ?? "Service";
        $shipping_price = json_decode(Cookie::get('shipping-price'), true) ?? 0;
        $cart = [];
        Cookie::queue('cartSepatu', json_encode($cart), 1209600);
        if ($product != null) {
            $cartSepatu = $product;
        }

        return view('checkout', compact('transaction', 'cartSepatu', 'userLoggedIn', 'shipping_description', 'shipping_price'));
    }


    // ================= checkout =================
    public function process(Request $req, $product=null)
    {
        // Shipping
        Cookie::queue('shipping-description', json_encode($req->input('shipping-description')), 1209600);
        Cookie::queue('shipping-price', json_encode($req->input('shipping-price')), 1209600);


        $cart = json_decode(Cookie::get('cartSepatu'), true); //cookie 14 hari
        $user = Session::get('userLoggedIn');
        $htrans_penjualan_id = rand(10000,99999);
        $totalProducts = 0;

        if ($cart == null) {
            $cart = $product;
        }

        if ($cart == null && $product == null) {
            return redirect('/products');
        }

        $transaction = htrans::create([
            'htrans_penjualan_id' => $htrans_penjualan_id,
            'fk_customer' => $user['id'],
            'htrans_penjualan_status' => 1,
        ]);

        foreach ($cart as $c) {
            if ($c['detail_id'] < 1001) { // ========== UTK CHECKOUT BARANG BUKAN RETUR
                $sepatu = DetailSepatu::find($c['detail_id']);
                // dd($sepatu);
                $subtotal = $c['qty']*$sepatu->detail_sepatu_harga;
                $dtrans = dtrans::create([
                    'fk_htrans_penjualan' => $htrans_penjualan_id,
                    'fk_detail_sepatu' => $sepatu->detail_sepatu_id,
                    'dtrans_penjualan_qty' => $c['qty'],
                    'dtrans_penjualan_price' => $sepatu->detail_sepatu_harga,
                    'dtrans_penjualan_subtotal' => $subtotal
                ]);
                $sepatu->detail_sepatu_stok -= $c['qty'];
                $sepatu->save();
                $totalProducts += $subtotal;
            } else {                    // ========== UTK CHECKOUT BARANG BUKAN RETUR
                $retur = retur::find($c['detail_id']-1000);
                $subtotal = $c['qty']*$retur->retur_price;
                $dtrans = dtrans::create([
                    'fk_htrans_penjualan' => $htrans_penjualan_id,
                    'fk_detail_sepatu' => $retur->fk_detail_sepatu,
                    'dtrans_penjualan_qty' => $c['qty'],
                    'dtrans_penjualan_price' => $retur->retur_price,
                    'dtrans_penjualan_subtotal' => $subtotal
                ]);
                $retur->retur_status = 10;
                $retur->save();
                $totalProducts += $subtotal;
            }
        }
        $totalProducts += $req->input('shipping-price');

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $htrans_penjualan_id,
                'gross_amount' => $totalProducts
            ),
            'customer_details' => array(
                'name' => $user['name'],
                'email' => $user['email'],
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction = htrans::find($htrans_penjualan_id);
        $transaction->snap_token = $snapToken;
        $transaction->htrans_penjualan_total = $totalProducts;
        $transaction->save();

        return redirect()->route('checkout', $htrans_penjualan_id);
    }

    // ================= DIRECT RETUR =================
    public function directProcess2($id)
    {
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true);

        if ($cartSepatu!=null) {
            $cartSepatu = [];
            Cookie::queue('cartSepatu', json_encode($cartSepatu), 1209600);
        }

        $sepatu = [
            "detail_id" => $id+1000,
            "qty" => 1
        ];

        array_push($cartSepatu, $sepatu);

        Cookie::queue('cartSepatu', json_encode($cartSepatu));
        return $this->process($cartSepatu);
    }

    public function success(htrans $transaction){
        $transaction->htrans_penjualan_status = 2;
        $transaction->save();

        $notif = new notifikasi();
        $notif->notifikasi_type = 1;
        $notif->notifikasi_content = "Ada pesanan baru dari ".$transaction->customer->user_email;
        $notif->save();

        return view('checkout-confirmation',  compact('transaction'));
    }

    public function details(htrans $transaction){
        return view('checkout-confirmation',  compact('transaction'));
    }

    public function cancel(htrans $transaction){
        $transaction->htrans_penjualan_status = 0;
        $transaction->save();

        return view('checkout-cancel',  compact('transaction'));
    }
}
