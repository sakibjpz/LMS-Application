<?php
date_default_timezone_set("Asia/Dhaka");
//echo $current_date=date("Y-m-d H:i:s");
function TokenGenerationFirst($length = 16) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
   }
	$current_date=date("Y-m-d H:i:s");
	$application_no=TokenGenerationFirst();  
$data = [
    "mer_info" => [
          "mer_reg_id" => "dinajpur_pourashava_test",
        "mer_pas_key" => "pG4?2O5^"
    ],
    //"req_timestamp" => "2020-11-08 18:14:00 GMT+6",
    "req_timestamp" =>$current_date." GMT+6",
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
        "ord_id" => " 12399999",
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


$headrtoken[] = 'Content-type: application/json'; 

		$api_url = "https://sandbox.ekpay.gov.bd/ekpaypg/v1/merchant-api";
        $curl = curl_init();

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // When the verify value is 0, the connection succeeds regardless of the names in the certificate.

        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headrtoken);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        echo $response = curl_exec($curl);
        $err = curl_error($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlErrorNo = curl_errno($curl);
        curl_close($curl);
        
        $token_output=json_decode($response,true);
  if(!empty($token_output["secure_token"])){      
 $payment_url="https://sandbox.ekpay.gov.bd/ekpaypg/v1?sToken=".$token_output["secure_token"]."&trnsID=".$application_no;        
        
echo "<script>window.open('$payment_url','_self')</script>";
}

?>