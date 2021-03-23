@extends('admin.layout.app')
@section('content')
<div>
    @include('admin.layout.sidebar')
    <div class="all-content-wrapper">
        @include('admin.layout.header')
        <div class="traffic-analysis-area">
            <div class="container-fluid">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="main-sparkline13-hd">
                                    <h1>View Order</h1>
                                </div>
                            </div>
                            <div class="col-md-3 m-b-15 text-right">
                                <a href="<?php echo asset('/').'textla/orderlist'?>"
                                    class="btn btn-primary btn-sm">Go to OrderList</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xsm-12">
                                <h4>{{$orders['order_no']}}<br><span class="text-muted">{{$orders['created_at']}}</span></h4>
                            </div>
                            <div class="col-md-3">
                                <span class="text-muted"> Name</span>
                                <h5> {{$orders['fullname']}}</h5>
                                <span class="text-muted">Email</span>
                                <h5> {{$orders['email']}}</h5>
                                <span class="text-muted"> Mobile </span>
                                <h5> {{$orders['contact_no']}}</h5>
                            </div>
                            <div class="col-md-3">
                                <h5>Address</h5>
                                <p class="text-muted">
                                {{$orders['address']}} <br>
                                {{$orders['city']}} <br>
                                {{$orders['state']}} - {{$orders['zipcode']}}<br>
                                {{$orders['country']}} <br>

                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="text-success"> 
                                @if($orders['order_status']==0)
                                        <span class="label label-warning">Ordered</span>
                                        @elseif($orders['order_status']==1)
                                        <span class="label label-primary">Packed</span>
                                        @elseif($orders['order_status']==2)
                                        <span class="label label-info">Shipped</span>
                                        @elseif($orders['order_status']==3)
                                        <span class="label label-success">Delivered</span>
                                        @elseif($orders['order_status']==4)
                                        <span class="label label-danger">Cancelled</span>
                                @endif
                                
                                </span>
                            </div>
                            <div class="col-md-2 ">
                                <h1> Total <br> {{$currency['config_value']}} {{$orders['totalprice']}}</h1>
                            </div>
                            <div class="col-md-2">
                                <a href="#" class="btn btn-danger"> <i class="fa fa-download" aria-hidden="true"></i>
                                    Invoice</a>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="sparkline13-list">
                    <div class="row">
                        <div class="col-md-6">
                            <table class=" table table-striped  table-hover table-responsive-sm mb-5">
                                <tbody>
                                @foreach($order_products as $row)
                                    <tr>
                                        <th><span class="text-danger">                                        
                                        </span></th>
                                        <th></th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Price</th>                                        
                                    </tr>
                                    <tr>
                                        <td width="60px"><img src="<?php echo asset('/').'public'?>/{{$row->media_url}}" class="category-image img-responsive img-fluid" ></td>
                                        <td width="50%"> <h4>{{ $row->product_name }}</h4></td>
                                        <td class="text-center">{{ $row->qty }}</td>
                                        <td class="text-center"> {{$currency['config_value']}} {{ $row->price }} </td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                Order Status History</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                            @foreach($OrderStatusHistory as $row)
                                                <div class="col-md-6">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                    <span class="">{{$row->updated_at}}</span>
                                                      
                                                </div>
                                                <div class="col-md-6">    
                                                                <h5> @if ($row->order_status == 0) Ordered 
                                                                @elseif ($row->order_status == 1) Packed
                                                                @elseif ($row->order_status == 2) Shipped
                                                                @elseif ($row->order_status == 3) Delivered
                                                                @elseif ($row->order_status == 4) Cancelled
                                                                @else  In Process
                                                                @endif</h5>
                                                       
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                Order Status Change</a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                    <input type="hidden" id="orderno_t1" value="{{$orders['order_no']}}" name="orderno_t1">
                                                    <input type="hidden" id="orderno_t2" value="{{$order_products[0]['order_id']}}" name="orderno_t2">
                                                        <select name="orderStatus" id="orderStatus" class="form-control form-control-sm">                                                           
                                                            <option value="0" <?php if($orders['order_status'] == 0){echo 'selected';}?>>Ordered</option>
                                                            <option value="1" <?php if($orders['order_status'] == 1){echo 'selected';}?>>Packed</option>
                                                            <option value="2" <?php if($orders['order_status'] == 2){echo 'selected';}?>>Shipped</option>
                                                            <option value="3" <?php if($orders['order_status'] == 3){echo 'selected';}?>>Delivered</option>
                                                            <option value="3" <?php if($orders['order_status'] == 4){echo 'selected';}?>>Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                Shipping Information</a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="username">Tracking ID</label>
                                                        <input type="text" placeholder="Tracking ID"
                                                            msg="Please enter you Tracking URL" value=""
                                                            name="tracking_ID" id="tracking_ID"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="username">Tracking URL</label>
                                                        <input type="text" placeholder="Tracking URL"
                                                            msg="Please enter you Tracking URL" value=""
                                                            name="tracking_URL" id="tracking_URL"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button type="button" class="btn btn-primary "> Save</button>
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
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                    <script>   
                                     
                        function fetch_data(val1, val2, data) { 
                            
                            $.ajax({
                                url: "<?php echo asset('/').'textla/orderview/changeorderStatus?orderid_t1='?>" + val1 + "&orderid_t2=" + val2 + "&value=" + data,
                                success: function(data) {                                                                       
                                    location.reload(true);
                                }
                            })
                        }
                        $( "#orderStatus" ).change(function() {
                           var data = $( "select option:selected" ).val();
                           var orderno_t1 = $('#orderno_t1').val();
                           var orderno_t2 = $('#orderno_t2').val();                                                       
                            fetch_data(orderno_t1, orderno_t2, data);
                        });   
                    </script>
    </div>
    @endsection