<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
use App\Models\sepatu;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
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

    // ================= CART CHECKOUT (DARI HALAMAN PRODUCT) =================
    public function process()
    {
        $cart = json_decode(Cookie::get('cartSepatu'), true); //cookie 14 hari
        $user = Session::get('userLoggedIn');
        $htrans_penjualan_id = rand(10000,99999);
        $totalProducts = 0;

        $transaction = htrans::create([
            'htrans_penjualan_id' => $htrans_penjualan_id,
            'fk_customer' => $user['id'],
            'htrans_penjualan_status' => 1,
        ]);

        foreach ($cart as $c) {
            $sepatu = sepatu::find($c['id']);
            $subtotal = $c['qty']*$sepatu->sepatu_price;
            $dtrans = dtrans::create([
                'fk_htrans_penjualan' => $htrans_penjualan_id,
                'fk_sepatu' => $c['id'],
                'fk_ukuran_sepatu' => $sepatu->sepatu_id,
                'dtrans_penjualan_qty' => $c['qty'],
                'dtrans_penjualan_price' => $sepatu->sepatu_price,
                'dtrans_penjualan_subtotal' => $subtotal
            ]);
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

    public function checkout(htrans $transaction)
    {
        $userLoggedIn = Session::get('userLoggedIn');
        $cartSepatu = json_decode(Cookie::get('cartSepatu'), true) ?? [];
        $cart = [];
        Cookie::queue('cartSepatu', json_encode($cart), 1209600);
        return view('checkout', compact('transaction', 'cartSepatu', 'userLoggedIn'));
    }

    // ================= DIRECT CHECKOUT (DARI HALAMAN PRODUCT) =================
    public function directProcess(Request $request, $id)
    {
        $cart = [];

        $selected = sepatu::find($id);
        $sepatu = [
            "id" => $selected->sepatu_id,
            "qty" => 1
        ];
        array_push($cart, $sepatu);
        Cookie::queue('cartSepatu', json_encode($cart), 1209600);

        return $this->process();
    }

    public function success(htrans $transaction){
        // Cookie::queue(Cookie::forget('cartSepatu'));

        $transaction->htrans_penjualan_status = 2;
        $transaction->save();

        return view('checkout-confirmation',  compact('transaction'));
    }

    public function details(htrans $transaction){
        return view('checkout-confirmation',  compact('transaction'));
    }

    public function cancel(htrans $transaction){
        // Cookie::queue(Cookie::forget('cartSepatu'));

        $transaction->htrans_penjualan_status = 0;
        $transaction->save();

        return view('checkout-cancel',  compact('transaction'));
    }
}
