<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ProceedController extends Controller
{
    public function proceed()
    {
        // Show the proceed page (button to pay)
        return view('frontend.proceed');
    }

    public function proceedPayment(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");

        // Generate Transaction ID
        $application_no = $this->generateToken(16);
        $current_date = date("Y-m-d H:i:s");

        // Save order to database
$order = \App\Models\Order::create([
    'user_id' => auth()->id(),
    'total_amount' => 11.00,  // TODO: later we use dynamic cart total
    'currency' => 'BDT',
    'status' => 'pending',
    'metadata' => [
        'transaction_id' => $application_no
    ]
]);


        // Payment API Data
        $data = [
            "mer_info" => [
                "mer_reg_id" => "dinajpur_pourashava_test",
                "mer_pas_key" => "pG4?2O5^"
            ],
            "req_timestamp" => $current_date . " GMT+6",
            "feed_uri" => [
                "c_uri" => "https://dp.admirerbd.com/AERVerification",
                "f_uri" => "https://dp.admirerbd.com/AERVerification",
                "s_uri" => "https://dp.admirerbd.com/AERVerification"
            ],
            "cust_info" => [
                "cust_email" => "aa@synesisit.com.bd",
                "cust_id" => "",
                "cust_mail_addr" => "dhaka",
                "cust_mobo_no" => "+8801795627460",
                "cust_name" => "aa"
            ],
            "trns_info" => [
                "ord_det" => "order-det",
                "ord_id" => "12399999",
                "trnx_amt" => "11.00",
                "trnx_currency" => "BDT",
                "trnx_id" => $application_no
            ],
            "ipn_info" => [
                "ipn_channel" => "1",
                "ipn_email" => "contact@admirerbd.com",
                "ipn_uri" => "https://dp.admirerbd.com/test/ipn"
            ],
            "mac_addr" => "1.1.1.1"
        ];

        // API request
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post("https://sandbox.ekpay.gov.bd/ekpaypg/v1/merchant-api", $data);

        $result = $response->json();

        if (!empty($result["secure_token"])) {
            $payment_url = "https://sandbox.ekpay.gov.bd/ekpaypg/v1?sToken=" . $result["secure_token"] . "&trnsID=" . $application_no;
            return redirect()->away($payment_url);
        }

        return "Payment token generation failed!";
    }

    private function generateToken($length = 16)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}
