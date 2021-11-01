@extends('layouts.admin_layout.admin_layout')
@section('content')

<?php
    // echo "<pre>"; print_r($getUserCountries); die;
    foreach ($getUserCountries as $key => $value) {
      // Manual way of referencing
      // $dataPoints[0]['label'] = $getUserCountries[$key]['country'];
      $dataPoints[$key]['label'] = $getUserCountries[$key]['country'];
      $dataPoints[$key]['y'] = $getUserCountries[$key]['count'];
    }      
?>

<script>
    window.onload = function() {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Register Users Countries Count"
        },
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "#,##\" Users\"",
            indexLabel: "{label} ({y})",
            dataPoints : <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    }
</script>
    
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
              <li class="breadcrumb-item active">Users Countries Report</li>
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
                <h3 class="card-title">Users Countries Reports</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
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
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection