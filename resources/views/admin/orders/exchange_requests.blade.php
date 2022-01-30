@extends('layouts.admin_layout.admin_layout')
@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogue</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Exchange Requests</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissable fade show" role="alert" style="margin-top:10px;">
                {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Exchange Requests</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="exchange_requests" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Product Size</th>
                    <th>Required Size</th>
                    <th>Product Code</th>
                    <th>Exchange Reason</th>
                    <th>Exchange Status</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Approve/Reject</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($exchange_requests as $request)
                        <tr>
                            <td>{{ $request['id'] }}</td>
                            <td><a target="_blank" href="{{ url('admin/orders/'.$request['order_id']) }}">#{{ $request['order_id'] }} </a></td>
                            <td>{{ $request['user_id'] }}</td>
                            <td>{{ $request['product_size'] }}</td>
                            <td>{{ $request['required_size'] }}</td>
                            <td>{{ $request['product_code'] }}</td>
                            <td>{{ $request['exchange_reason'] }}</td>
                            <td>{{ $request['exchange_status'] }}</td>
                            <td>{{ $request['comment'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($request['created_at'])) }}</td>
                            <td>
                              <form method="post" action="{{ url('admin/exchange-requests/update') }}">
                                @csrf
                                <input type="hidden" name="exchange_id" value="{{ $request['id'] }}">
                                <select class="form-control" name="exchange_status">
                                  <option @if($request['exchange_status'] == "Approved") selected @endif value="Approved">Approved</option>
                                  <option @if($request['exchange_status'] == "Rejected") selected @endif value="Rejected">Rejected</option>
                                  <option @if($request['exchange_status'] == "Pending") selected @endif value="Pending">Pending</option>
                                </select><br>
                                <button type="submit" class="btn btn-success" name="" value="Update">Update</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection