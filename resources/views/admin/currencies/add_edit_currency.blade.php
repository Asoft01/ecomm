@extends('layouts.admin_layout.admin_layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Currencies</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if($errors->any())
        <div class="alert alert-danger" style="margin-top: 10px;">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
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
          <form name="currencyForm" id="currencyForm" @if(empty($currency['id'])) action="{{ url('admin/add-edit-currency') }}" @else action="{{ url('admin/add-edit-currency/'.$currency['id']) }}" @endif method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label for="currency_code">Currency Code</label>
                        <input type="text" class="form-control" name="currency_code" id="currency_code" placeholder="Enter Currency Name" @if(!empty($currency['currency_code'])) value="{{ $currency['currency_code'] }}" @else value="{{ old('currency_code') }}" @endif required>
                    </div>

                    <div class="form-group">
                        <label for="exchange_rate">Exchange Rate</label>
                        <input type="number" class="form-control" name="exchange_rate" id="exchange_rate" placeholder="Enter Exchange Rate" @if(!empty($currency['exchange_rate'])) value="{{ $currency['exchange_rate'] }}" @else value="{{ old('exchange_rate') }}" @endif required>
                    </div>
                </div>
                <!-- /.col -->
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
          </form>        
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection