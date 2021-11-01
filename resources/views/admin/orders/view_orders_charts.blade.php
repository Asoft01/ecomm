@extends('layouts.admin_layout.admin_layout')
@section('content')

<?php
// echo "<pre>"; print_r($ordersCount); die;
    $months= array();
    $count = 0;
    while($count <= 3){
        $months[] = date('M Y', strtotime("-".$count." month"));
        $count++;
    }
    // echo "<pre>"; print_r($months); die;
    $dataPoints = array(
        array("y" => $ordersCount[3], "label" => $months[3]),
        array("y" => $ordersCount[2], "label" => $months[2]),
        array("y" => $ordersCount[1], "label" => $months[1]),
        array("y" => $ordersCount[0], "label" => $months[0]),
    )

?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Orders Report"
	},
	axisY: {
		title: "Number of Reports"
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "grey",
		legendText: "MMbbl = one million barrels",
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
              <li class="breadcrumb-item active">Orders Reports</li>
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
                <h3 class="card-title">Orders Reports</h3>
                
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