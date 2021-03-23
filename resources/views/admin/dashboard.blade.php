@extends('admin.layout.app')
@section('content')
    <div>
        @include('admin.layout.sidebar')
        <div  class="all-content-wrapper">
        @include('admin.layout.header')
             <div class="traffic-analysis-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalCategory; ?></h3>
                                    <p>Category</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalProduct; ?></h3>
                                    <p>Product</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalInstockproduct; ?></h3>
                                    <p>In Stock Product</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalOutstockproduct; ?></h3>
                                    <p>Out Stock Product</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalUsers; ?></h3>
                                    <p>Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3>{{$currency}}<?php echo $totalPayment.$currType; ?></h3>
                                    <p>Payment</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalOrder; ?></h3>
                                    <p>Order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalOrderedstatus; ?></h3>
                                    <p>Ordered Order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalPackedstatus; ?></h3>
                                    <p>Packed Order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalShippedstatus; ?></h3>
                                    <p>Shipped Order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalDeliveredstatus; ?></h3>
                                    <p>Delivered Order</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <div class="social-media-edu">
                               <div class="social-edu-ctn">
                                    <h3><?php echo $totalCancelledstatus; ?></h3>
                                    <p>Cancelled Order</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"> Monthly Sales Order</div>
                                <div class="panel-body"><canvas id="canvasOrder"></canvas></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"> Monthly Sales Payment</div>
                                <div class="panel-body"><canvas id="canvasPayment"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Recent Customers</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                    <table class="tree table table-striped table-bordered table-hover table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th width="40%">Customer Name</th>
                                                <th width="40%">Email</th>
                                                <th width="20%">Mobile</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            @foreach($latestuser as $row)                      
                                                <tr>
                                                    <td><a href="<?php echo asset('/').'textla/customer'?>"> {{$row['fullname']}}</a></td>
                                                    <td>{{$row['email']}}</td>
                                                    <td>{{$row['mobile']}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div></div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Recent Ordered</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="tree table table-striped table-bordered table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Order No</th>
                                                        <th width="50%">Customer Name</th>
                                                        <th width="20%">Mobile</th>
                                                        <th width="15%">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>  
                                                    @foreach($latestorder as $row)                      
                                                        <tr>
                                                            <td><span class="label label-primary">{{$row['order_no']}}</span></td>
                                                            <td><a href="<?php echo asset('/').'textla/orderlist'?>"> {{$row['fullname']}}</a></td>
                                                            <td>{{$row['contact_no']}}</td>
                                                            <td>{{$currency}}{{$row['totalprice']}}{{$currType}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Recent Selling Products</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="tree table table-striped table-bordered table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Product Image</th>
                                                        <th width="50%">Product Name</th>
                                                        <th width="20%">Product SKU</th>
                                                        <th width="15%">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>  
                                                    @foreach($recentsalesproduct as $row)
                                                    <tr>
                                                        <td><img src="<?php echo asset('/').'public'?>/{{$row->media_url}}" class="category-image img-responsive img-fluid" ></td>                                                                                                        
                                                        <td><a href="<?php echo asset('/').'textla/product'?>"> {{ $row->product_name}}</a> </td>
                                                        <td><span class="label label-success">{{ $row->product_sku }}</span></td>  
                                                        <td>{{$currency}}{{ $row->total_cost }}{{$currType}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Top Selling Products</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="tree table table-striped table-bordered table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Product Image</th>
                                                        <th width="50%">Product Name</th>
                                                        <th width="20%">Product SKU</th>
                                                        <th width="15%">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>  
                                                    @foreach($topsellingproduct as $row)
                                                    <tr>
                                                        <td><img src="<?php echo asset('/').'public'?>/{{$row->media_url}}" class="category-image img-responsive img-fluid" ></td>                                                                                                        
                                                        <td><a href="<?php echo asset('/').'textla/product'?>"> {{ $row->product_name}}</a></td>
                                                        <td><span class="label label-success">{{ $row->product_sku }}</span></td>  
                                                        <td>{{$currency}}{{ $row->total_cost }}{{$currType}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"  crossorigin="anonymous"></script>
    <script>
        var label = new Array();
        <?php foreach($monthlySalesOrder as $val){ ?>
            label.push('<?php echo $val; ?>');
        <?php } ?>
        var monthlySalesData = new Array();
        <?php foreach($monthlySalesData as $val){ ?>
            monthlySalesData.push('<?php echo $val; ?>');
        <?php } ?>

        var monthlySalesPaymentData = new Array();
        <?php foreach($monthlySalesPaymentData as $val){ ?>
            monthlySalesPaymentData.push('<?php echo $val; ?>');
        <?php } ?>
        var monthlySalesPaymentMonth = new Array();
        <?php foreach($monthlySalesPaymentMonth as $val){ ?>
            monthlySalesPaymentMonth.push('<?php echo $val; ?>');
        <?php } ?>
        
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var color = Chart.helpers.color;
       
      	var oderBarChartData = {
			labels: label,
			datasets: [{
				label: 'No Of Order',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: monthlySalesData
			}]
        };
        var paymentBarChartData = {
			labels: monthlySalesPaymentMonth,
			datasets: [{
				label: 'Order Payment (<?php echo($currency); ?>)',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: monthlySalesPaymentData
			}]
		};
		window.onload = function() {
			var ctx = document.getElementById('canvasOrder').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: oderBarChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Monthly Sales Order'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                stepSize: 1
                            }
                        }]
                    }
				}
			});
            var ctx = document.getElementById('canvasPayment').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: paymentBarChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Monthly Sales Order Payment'
					}
				}
			});

		};

    </script>

@endsection
