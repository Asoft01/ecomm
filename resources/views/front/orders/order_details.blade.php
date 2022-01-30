<?php 
use App\Product; 
use App\Order;
//  echo $getOrderStatus = Order::getOrderStatus($orderDetails['id']); die;
$getOrderStatus = Order::getOrderStatus($orderDetails['id']); 
?>
@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active"><a href="{{ url('/orders') }}"> Orders</a> </li>
    </ul>
	<h3> Orders #{{ $orderDetails['id'] }} Details
        @if($getOrderStatus == "New")
            {{-- <span style="float:right;"><a href="{{ url('orders/'.$orderDetails['id'].'/cancel') }}"> <button type="button" class="btn block btnCancelOrder">Cancel Order </button></span> --}}
        <!-- Button trigger modal -->
        <button style="float:right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancelModal">
            Cancel Order
        </button>
        @endif
        @if($getOrderStatus == "Delivered")
            {{-- <span style="float:right;"><a href="{{ url('orders/'.$orderDetails['id'].'/cancel') }}"> <button type="button" class="btn block btnCancelOrder">Cancel Order </button></span> --}}
            <!-- Button trigger modal -->
            <button style="float:right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#returnModal">
                Return/Exchange Order
            </button>
        @endif
        
    </h3>
    @if(Session::has('success_message'))
        <div class="alert alert-success" role="alert" style="margin-top:10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php Session::forget('success_message'); ?>
    @endif
    @if(Session::has('error_message'))
        <div class="alert alert-danger" role="alert" style="margin-top:10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php Session::forget('error_message'); ?>			
    @endif	
            	
    <hr class="soft"/>

    <div class="row">
        <div class="span4">	
            <table class="table table-striped table-bordered">
                <tr>
                    <td colspan="2"><strong>Order Details</strong></td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td>{{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}</td>
                </tr>
                <tr>
                    <td>Order Status</td>
                    <td>{{ $orderDetails['order_status'] }}</td>
                </tr>
                @if(!empty($orderDetails['courier_name']))
                <tr>
                    <td>Courier Name</td>
                    <td>{{ $orderDetails['courier_name'] }}</td>
                </tr>
                @endif
                @if(!empty($orderDetails['tracking_number']))
                <tr>
                    <td>Tracking Number</td>
                    <td>{{ $orderDetails['tracking_number'] }}</td>
                </tr>
                @endif     
                <tr>
                    <td>Order Total</td>
                    <td>{{ $orderDetails['grand_total'] }}</td>
                </tr>
                <tr>
                    <td>Shipping Charges</td>
                    <td>{{ $orderDetails['shipping_charges'] }}</td>
                </tr>
                <tr>
                    <td>Coupon Code</td>
                    <td>{{ $orderDetails['coupon_code'] }}</td>
                </tr>
                <tr>
                    <td>Coupon Amount</td>
                    <td>{{ $orderDetails['coupon_amount'] }}</td>
                </tr>
                <tr>
                    <td>Payment Method</td>
                    <td>{{ $orderDetails['payment_method'] }}</td>
                </tr>
                        
            </table>
        </div>
        <div class="span4">	
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>Delivery Address</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $orderDetails['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $orderDetails['address'] }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{ $orderDetails['city'] }}</td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>{{ $orderDetails['state'] }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $orderDetails['country'] }}</td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td>{{ $orderDetails['pincode'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $orderDetails['mobile'] }}</td>
                    </tr>
                    
                    
                </table>
            </div>
    </div>
	
	<div class="row">
		<div class="span8">	
			<table class="table table-striped table-bordered">
                <tr>
                    <th>Product Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Size</th>
                    <th>Product Color</th>
                    <th>Product Qty</th>
                    <th>Item Status</th>
                    {{-- <th>Details</th> --}}
                </tr>
                @foreach ($orderDetails['orders_products'] as $product)
                    <tr>
                        {{-- <td><?php// echo Product::getProductImage($product['product_id']); ?></td> --}}
                        <td>
                            <?php $getProductImage= Product::getProductImage($product['product_id']); ?>
                            <a target="_blank" href="{{ url('product/'.$product['product_id']) }}"><img width="80px" src="{{ asset('images/product_images/small/'.$getProductImage) }}">
                        </td>
                        <td>{{ $product['product_code'] }}</td>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{ $product['product_size'] }}</td>
                        <td>{{ $product['product_color'] }}</td>
                        <td>{{ $product['product_qty'] }}</td>
                        <td>{{ $product['item_status'] }}</td>
                    </tr>
                @endforeach
            </table>
		</div>
	</div>	
	
</div>

<!-- Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <form method="POST" action="{{ url('orders/'.$orderDetails['id'].'/cancel') }}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Reason for Cancellation</h5>
                </div>
                <div class="modal-body">
                    <select name="reason" id="cancelReason">
                        <option value="">Select Reason</option>
                        <option value="Order Created by Mistake">Order Created by Mistake</option>
                        <option value="Item Not Arrive on Time">Item Not Arrive on Time</option>
                        <option value="Shipping Cost Too High">Shipping Cost Too High</option>
                        <option value="Found Cheaper Somewhere Else">Found Cheaper Somewhere Else</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnCancelOrder">Cancel Order</button>
                </div>
            </div>
        </div>
    </form>
  </div>

  <!-- Return -- Modal -->
  <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true" style="width: 380px" >
    <form method="POST" action="{{ url('orders/'.$orderDetails['id'].'/return') }}">
        @csrf
        <div class="modal-dialog" role="document" align="center">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">Reason for Return/Exchange</h5>
                </div>
                <div class="modal-body">
                    <select name="return_exchange" id="returnExchange">
                        <option value="">Select Return/Exchange</option>
                        <option value="Return">Return</option>
                        <option value="Exchange">Exchange</option>
                    </select>
                </div>

                <div class="modal-body">
                    <select name="product_info" id="returnProduct">
                        <option value="">Select Product</option>
                        @foreach ($orderDetails['orders_products'] as $product)
                            @if($product['item_status'] != "Return Intitiated")
                                <option value="{{ $product['product_code'] }}--{{ $product['product_size'] }}">{{ $product['product_code'] }}--{{ $product['product_size'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="modal-body productSizes">
                    <select name="required_size" id="productSizes">
                        <option value="">Select Required Size</option>
                    </select>
                </div>
                <div class="modal-body">
                    <select name="return_reason" id="returnReason">
                        <option value="">Select Reason</option>
                        <option value="Performance or quality not adequaate">Performance or quality not adequaate</option>
                        <option value="Product damaged, but shipping box OK">Product damaged, but shipping box OK</option>
                        <option value="Item arrived too late">Item arrived too late</option>
                        <option value="Wrong Item was sent">Wrong Item was sent</option>
                        <option value="Item defective was sent">Item defective was sent</option>
                        <option value="Item defective or doesn't work">Item defective or doesn't work</option>
                        <option value="Require Smaller Size">Require Smaller Size</option>
                        <option value="Require Larger Size">Require Larger Size</option>
                        </select>
                </div>

                <div class="modal-body">
                    <textarea name="comment" placeholder="Comment"></textarea>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnReturnOrder">Submit</button>
                </div>
            </div>
        </div>
    </form>
  </div>
@endsection