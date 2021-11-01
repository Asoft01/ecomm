<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;

class PayumoneyController extends Controller
{
    public function payumoney(){
        $parameters = [
            'txnid' => '28309039994988',
            'order_id' => '28309039994988',
            'amount' => '1200.00',
            'firstname' => 'Adeleke',
            'lastname' => 'Hammed',
            'name' => 'Adeleke Hammed',
            'email' => 'prymable@gmail.com',
            'phone' => '',
            'productinfo' => '28309039994988',
            'service_provider' => '',
            'zipcode' => '141001',
            'city' => 'Ludhina',
            'state' => 'Punjab',
            'country' => 'India',
            'address1' => '123 - Mall Road',
            'address2' => 'Civil Lines',
            'curl' => url('payumoney/response')
          ];
          
          $order = Indipay::prepare($parameters);
          return Indipay::process($order);
    }

    public function response(Request $request)

    {
        // For default Gateway
        $response = Indipay::response($request);

        // For Otherthan Default Gateway
        $response = Indipay::gateway('PayUMoney')->response($request);

        dd($response);
    } 
}
