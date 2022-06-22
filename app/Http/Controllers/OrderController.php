<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Mpesa;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('updated_at', 'DESC')
                    ->with('user')
                    ->get();

        return response()->json([
            'orders' => $orders
        ], 200);
    }

    public function showUserOrders()
    {
        $user = Auth::user()->id;
        $orders = Order::where('user_id', $user)
                    ->orderBy('updated_at', 'Desc')
                    ->get();
        // return $orders->order_id;
        return response()->json([
            'orders' => $orders
        ], 200);
    }

    public function orderDetail($order_id)
    {
        $order = Order::where('order_id', $order_id)
                ->with('user')
                ->first();

        return response()->json([
            'order' => $order
        ], 200);
    }

    public function getUserOrder($order_id)
    {
        $order = Order::where('order_id', $order_id)
                ->with('user')
                ->first();

        return response()->json([
            'order' => $order
        ], 200);
    }

    public function showSpecificUserOrder($order_id)
    {
        $order = Order::where('order_id', $order_id)
                    ->with('user')
                    ->first();

        // return $order;

        return response()->json([
            'order' => $order
        ], 200);
    }

    public function downloadPdf($order_id)
    {
        // return $order_id;
        $order = Order::where('order_id', $order_id)
                ->with('user')
                ->first();
        
        $data = [
            'order_name' => $order_id
        ];

        // return $order->user->name;

        $pdf = PDF::loadView('order.invoice', $data);

        Order::sendCustomerEmail($order, $pdf);

        return response()->json('success', 200);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // return $request;
        $user = Auth::user()->id;
        $product = $request->cart;
        $shipping = $request->form;
        // return $product;
        $order_id = rand(99999, 999999);
        $total = $request->total;
        if ($request->payment['cash_on_delivery']) {

            $products = Cart::where('user_id', $user)->get();

            // $productSave = serialize($product);

            Order::create([
                'product' => $product,
                'shipping' => $shipping,
                'user_id' => $user,
                'order_id' => $order_id,
                'total' => $total,
                'payment' => 'cash_on_delivery',
                'status' => 'pending'
            ]);

            $this->downloadPdf($order_id);

            Cart::where('user_id', $user)->delete();

            return response()->json('success', 200);

        }
        else if ($request->payment['mpesa']) {
            $shippingaddress = json_encode($request->form);

            $products = Cart::where('user_id', $user)->get();
            $productSave = json_encode($products);

            Order::create([
                'product' => $productSave,
                'shipping' => $shippingaddress,
                'user_id' => $user,
                'order_id' => $order_id,
                'total' => $total,
                'payment' => 'mpesa',
                'status' => 'pending'
            ]);

            Cart::where('user_id', $user)->delete();

            return response()->json('success', 200);
        }
        else if ($request->payment['paypal']) {
            $shippingaddress = json_encode($request->form);

            $products = Cart::where('user_id', $user)->get();
            $productSave = json_encode($products);

            Order::create([
                'product' => $productSave,
                'shipping' => $shippingaddress,
                'user_id' => $user,
                'order_id' => $order_id,
                'total' => $total,
                'payment' => 'paypal',
                'status' => 'pending'
            ]);

            Cart::where('user_id', $user)->delete();

            return response()->json('success', 200);
        }
        else if ($request->payment['card']) {
            $shippingaddress = json_encode($request->form);

            $products = Cart::where('user_id', $user)->get();
            $productSave = json_encode($products);

            Order::create([
                'product' => $productSave,
                'shipping' => $shippingaddress,
                'user_id' => $user,
                'order_id' => $order_id,
                'total' => $total,
                'payment' => 'card',
                'status' => 'pending'
            ]);

            Cart::where('user_id', $user)->delete();

            return response()->json('success', 200);
        }
        else {
            return response()->json([
                'message' => 'Order request failed'
            ], 201);
        }
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }

    // MPESA FUNCTIONS
    
    public function lipaNaMpesaPassword()
    {
        $lipa_time = Carbon::rawParse('now')->format('YmdHms');
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $BusinessShortCode = 174379;
        $timestamp =$lipa_time;
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);
        return $lipa_na_mpesa_password;
    }
    /**
     * Lipa na M-PESA STK Push method
     * */
    public function customerMpesaSTKPush(Request $request)
    {
        // return $request;
        $total = $request->total;
        $user = Auth::user()->phone;
        $phone_number = substr($user->phone, -9);
        $phone_number = '254'.$phone_number;
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => 174379,
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $total,
            'PartyA' => $phone_number, // replace this with your phone number
            'PartyB' => 174379,
            'PhoneNumber' => $phone_number, // replace this with your phone number
            'CallBackURL' => 'https://blog.hlab.tech/',
            'AccountReference' => "RP",
            'TransactionDesc' => "Testing stk push on sandbox"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        // return $curl_response;
        return response()->json($curl_response, 200);
    }

    // GENERATE ACCCESS TOKEN
    public function generateAccessToken()
    {
        $consumer_key="zxdsKnlqTfI0KPnjnsAAePkdUcKw0TGn";
        $consumer_secret="mk4LGVRW51M5luvt";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        return $access_token->access_token;
    }

    /**
     * J-son Response to M-pesa API feedback - Success or Failure
     */
    public function createValidationResponse($result_code, $result_description){
        $result=json_encode(["ResultCode"=>$result_code, "ResultDesc"=>$result_description]);
        $response = new Response();
        $response->headers->set("Content-Type","application/json; charset=utf-8");
        $response->setContent($result);
        return $response;
    }

    /**
     *  M-pesa Validation Method
     * Safaricom will only call your validation if you have requested by writing an official letter to them
     */
    public function mpesaValidation(Request $request)
    {
        $result_code = "0";
        $result_description = "Accepted validation request.";
        return $this->createValidationResponse($result_code, $result_description);
    }

    /**
     * M-pesa Transaction confirmation method, we save the transaction in our databases
     */
    public function mpesaConfirmation(Request $request)
    {
        $content=json_decode($request->getContent());
        $mpesa_transaction = new Mpesa();
        $mpesa_transaction->TransactionType = $content->TransactionType;
        $mpesa_transaction->TransID = $content->TransID;
        $mpesa_transaction->TransTime = $content->TransTime;
        $mpesa_transaction->TransAmount = $content->TransAmount;
        $mpesa_transaction->BusinessShortCode = $content->BusinessShortCode;
        $mpesa_transaction->BillRefNumber = $content->BillRefNumber;
        $mpesa_transaction->InvoiceNumber = $content->InvoiceNumber;
        $mpesa_transaction->OrgAccountBalance = $content->OrgAccountBalance;
        $mpesa_transaction->ThirdPartyTransID = $content->ThirdPartyTransID;
        $mpesa_transaction->MSISDN = $content->MSISDN;
        $mpesa_transaction->FirstName = $content->FirstName;
        $mpesa_transaction->MiddleName = $content->MiddleName;
        $mpesa_transaction->LastName = $content->LastName;
        $mpesa_transaction->save();
        // Responding to the confirmation request
        $response = new Response();
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));
        return $response;
    }

     /**
     * M-pesa Register Validation and Confirmation method
     */
    public function mpesaRegisterUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Bearer '. $this->generateAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'ShortCode' => "600141",
            'ResponseType' => 'Completed',
            'ConfirmationURL' => "https://blog.hlab.tech/api/v1/hlab/transaction/confirmation",
            'ValidationURL' => "https://blog.hlab.tech/api/v1/hlab/validation"
        )));
        $curl_response = curl_exec($curl);
        echo $curl_response;
    }

}
