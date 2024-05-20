<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TsuripayController extends Controller
{
    public function index(Request $request)
    {   
        $client = new Client([
            'verify' => false,
        ]);
        if($request->invoiceId == null){
            return view('tsuripay/scanQR');
        }
        $response = $client->get('https://stg.bizmanager.jp/api/tsuripay/info/invoice?invoiceId=33583');

        if( $response->getStatusCode() == 200 ){
            $body = $response->getBody()->getContents(); // Get the response body
            $data = json_decode($body, true); // Decode JSON response
            return view('tsuripay/payment-method', $data);
        }    

        return view('tsuripay/index');
    }

    public function paymentMethod(Request $request)
    {
        $data_payment = json_decode($request->data, TRUE);
        $payment_method = $request->paymentMethod;
        $data = [
            'data' => $data_payment,
            'payment_method' => $payment_method
        ];

        return view('tsuripay/payment', $data);
    }

    public function payment(Request $request)
    {   
        $today = Carbon::today()->format('Y-m-d H:i:s');
        $data_invoice = json_decode($request->data, TRUE);
        $data = [
            'invoice_id' => $data_invoice['invoice_id'],
            'status_payment_tsuripay' => 'Success',
            'date_payment_tsuripay' => $today,
            'price_tsuripay' => $data_invoice['price'],
            'user_price_tsuripay' => $request->user_price,
            'out_price_tsuripay' =>  $request->out_price,
            'type_payment_tsuripay' => $request->paymentMethod
        ];
        $client = new Client([
            'verify' => false,
            'base_uri' => 'https://stg.bizmanager.jp/',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer your-token', // Replace with your actual token
            ],
        ]);
        try {
            $response = $client->post('/api/tsuripay/payment',[
                'json' => $data    
            ]
        );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return view('tsuripay/fail');
            dd(json_decode($responseBodyAsString, TRUE));
        }
        catch (\GuzzleHttp\Exception\RequestException $e) {
            return view('tsuripay/fail');
            dd($e->getMessage());
        }
        $body = $response->getBody();
        $data = json_decode($body, true);

        if($data['success'] == true){
            return view('tsuripay/success');
        }
    }
}