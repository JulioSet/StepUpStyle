<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function index()
    {
        // Set up Midtrans configuration
        Config::$serverKey = config('services.midtrans.server_key');

        // Retrieve payment details from the request or database
        $order_id = uniqid();
        $amount = 10000; // Replace with the actual amount
        $customer_name = 'John Doe';
        $customer_email = 'john.doe@example.com';
        $customer_phone = '081234567890';

        // Set transaction details
        $transaction_details = [
            'order_id' => $order_id,
            'gross_amount' => $amount,
        ];

        // Set customer details
        $customer_details = [
            'first_name' => $customer_name,
            'email' => $customer_email,
            'phone' => $customer_phone,
        ];

        // Prepare transaction data
        $transaction_data = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];


        // Create Snap Token
        try {
            $snapToken = Snap::getSnapToken($transaction_data);
        } catch (\Exception $e) {
            // Handle any errors that occur during token generation
            return redirect()->route('payment.error');
        }

        return view('payment.payment-page', compact('snapToken'));
    }

    public function notification(Request $request)
    {
        $notification = json_decode($request->getContent(), true);

        // Process the notification and update your database accordingly

        return response(['status' => 'OK']);
    }
}
