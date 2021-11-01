@extends('layouts.admin_layout.admin_layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Other Settings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Other Settings </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Other Settings </h3>
                </div>
                <!-- /.card-header -->
                @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert" style="margin-top:10px;">
                  {{ Session::get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissable fade show" role="alert" style="margin-top:10px;">
                  {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                
                <!-- form start -->
                <form role="form" method="POST" action="{{ url('/admin/update-other-settings') }}" name="updatePasswordForm" id="updatePasswordForm">
                @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Min Cart Value</label>
                        <input class="form-control" value="{{ $otherSettings['min_cart_value'] }}" type="text" placeholder="Enter Min Cart Value" id="min_cart_value" name="min_cart_value">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Max Cart Value</label>
                        <input class="form-control" value="{{ $otherSettings['max_cart_value'] }}" type="text" placeholder="Enter Max Cart Value" id="max_cart_value" name="max_cart_value">
                    </div>
                    
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
  
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

</div>
<!-- /.content-wrapper -->

@endsection