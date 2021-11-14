<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrdersLog;
use Auth;
use Session;
class OrdersController extends Controller
{
    public function orders(){
        $orders = Order::with('orders_products')->where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();
        // dd($orders); die;
        return view('front.orders.orders')->with(compact('orders'));
    }

    public function orderDetails($id){
        $orderDetails= Order::with('orders_products')->where('id', $id)->first()->toArray();
        // dd($orderDetails); die;
        return view('front.orders.order_details')->with(compact('orderDetails'));
    }

    public function orderCancel($id, Request $request){
        if($request->post()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if(isset($data['reason']) && empty($data['reason'])){
                return redirect()->back();
            }
            
            // echo "<pre>"; print_r($data); die;

            // Get User ID from Order
            $user_id_auth = Auth::user()->id;

            // Get User ID from Order
            $user_id_order= Order::select('user_id')->where('id', $id)->first();

            // echo $user_id_auth;
            // echo "---";
            // echo $user_id_order->user_id; die;

            if($user_id_auth == $user_id_order->user_id){
                // echo $id; die;
                // Update Order Status to be Cancelled
                Order::where('id', $id)->update(['order_status'=> 'Cancelled']);

                //Update Order Log
                $log = new OrdersLog();
                $log->order_id = $id; 
                $log->order_status = "User Cancelled";
                $log->reason = $data['reason'];
                $log->updated_by = "User";
                $log->save();

                $message = "Order has been Cancelled";
                Session::flash('success_message', $message);
                return redirect()->back();   
            }else{
                $message = "Your Order Cancellation Request is not Valid";
                Session::flash('error_message', $message);
                return redirect('orders');
            } 
        }
    }

    // public function orderCancel($id){

    //     // Get User ID from Order
    //     $user_id_auth = Auth::user()->id;

    //     // Get User ID from Order
    //     $user_id_order= Order::select('user_id')->where('id', $id)->first();

    //     // echo $user_id_auth;
    //     // echo "---";
    //     // echo $user_id_order->user_id; die;
    //     if($user_id_auth == $user_id_order->user_id){
    //         // echo $id; die;
    //         // Update Order Status to be Cancelled
    //         Order::where('id', $id)->update(['order_status'=> 'Cancelled']);

    //         //Update Order Log
    //         $log = new OrdersLog();
    //         $log->order_id = $id; 
    //         $log->order_status = "Cancelled";
    //         $log->save();

    //         $message = "Order has been Cancelled";
    //         Session::flash('success_message', $message);
    //         return redirect()->back();   
    //     }else{
    //         $message = "Your Order Cancellation Request is not Valid";
    //         Session::flash('error_message', $message);
    //         return redirect('orders');
    //     }
    // }

    public function orderReturn($id, Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            echo $id;
            echo "<pre>"; print_r($data); die;
        }
    }
}
