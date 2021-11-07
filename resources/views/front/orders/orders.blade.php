@extends('layouts.front_layout.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Orders</li>
    </ul>
	<h3> Orders </h3>	
    <hr class="soft"/>
    
    @if(Session::has('error_message'))
        <div class="alert alert-danger" role="alert" style="margin-top:10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <?php Session::forget('error_message'); ?>			
    @endif	
        
    @if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissable fade show" role="alert" style="margin-top:10px;">
      {{ Session::get('success_message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
	<div class="row">
		<div class="span8">	
			<table class="table table-striped table-bordered">
                <tr>
                    <th>Order ID</th>
                    <th>Order Products</th>
                    <th>Payment Method</th>
                    <th>Grand Total</th>
                    <th>Created On</th>
                    {{-- <th>Details</th> --}}
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td><a href="{{ url('orders/'.$order['id']) }}">#{{ $order['id'] }}</a></td>
                        <td>
                            @foreach ($order['orders_products'] as $pro)
                                {{ $pro['product_code'] }}<br>
                            @endforeach
                        </td>
                        <td>{{ $order['payment_method'] }}</td>
                        <td>INR {{ $order['grand_total'] }}</td>
                        <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
                        <td><a style="text-decoration:underline;" href="{{ url('orders/'.$order['id']) }}">View Details</a></td>
                    </tr>
                @endforeach
            </table>
		</div>
	</div>	
	
</div>
@endsection