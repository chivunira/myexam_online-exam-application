<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Epayment;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MpesaController extends Controller
{
    public function generateAccessToken() {
        $consumer_key = 'LhWsqxGK9cY58Gg9bcLCEiwoVx0wsInv';
        $consumer_secret = '4YUEBcJwKALxnlmX';
        $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode($consumer_key . ':' . $consumer_secret)
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Add this line
        $response = curl_exec($ch);
        $access_token = json_decode($response);
        $token_value = $access_token->access_token;
        return $token_value;
    }

    public function STKPush(){
        $userID = Auth::id();
        $user = User::find($userID);
        $student = Student::where('user_id', $userID)->first();
    
        $business_shortcode = 174379;
        $timestamp= Carbon::rawParse('now')->format('YmdHms');
        $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $password = base64_encode($business_shortcode . $passkey . $timestamp);
        $amount = '1';
        $partyA = 254745370117; // customer, person paying.
        $partyB = 174379; //till number for the organization
        $payment_for = 'nothing for now';

        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        
        $token_value = $this->generateAccessToken();

        $headers = [
            'Authorization: Bearer ' . $token_value,
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $data = [
            'BusinessShortCode' => $business_shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $partyA,
            'PartyB' => $partyB,
            'PhoneNumber' => $partyA,
            'CallBackURL' => 'https://2acb-105-160-46-77.ngrok-free.app/payment/',
            'AccountReference' => 'myExam',
            'TransactionDesc' => $payment_for,
        ];

        $payload = json_encode($data);
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        // dd($response); 

        $response_data = json_decode($response);
        
        if(isset($response_data->ResponseCode)){
            // Check if the request was successful
            if ($response_data->ResponseCode == '0') {
                sleep(15);
                // Redirect the user to the payment page
                return $this->handleCallback($response_data->CheckoutRequestID);
            } else {
                return response()->json(['status' => 'transaction failed']);
            }
        }
        else{
            return redirect()->back()->with('message', 'Servers are currently down, please try the payment later');
        }   
    }

    function handleCallback($checkoutRequestID, Request $request) {
        // Get the checkout request ID from the request
        $checkoutRequestID = $request->input('checkoutRequestID');
        dd($checkoutRequestID);
    
        // Store the checkout request ID in the database
        // DB::table('stk_pushes')->insert([
        //     'checkoutRequestID' => $checkoutRequestID,
        //     'status' => 'Pending',
        // ]);
    
        // Redirect the user to the payment page
        return redirect()->route('payment');
    }

    
    
    
}
