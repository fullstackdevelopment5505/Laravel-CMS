@extends('layouts.master')
@section('content')
<!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <a href="/order">My Order</a>
                        <span>Order Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                @include('layouts.sidebar')
                <div class="col-lg-9 order-1 order-lg-2">
                     @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{session('success')}}
                        </div>
                        @endif
                    <div class="card">
                        <div class="card-header">
                            ORDER #{{$order['order_no']}}
                            <a href="/myorder" class="btn btn-primary btn-sm pull-right">Back</a>
                            @if(isset($review) && $order['order_status']==3)
                            <a href="/order/invoice/{{$order['order_no']}}" target="_blank" class="btn btn-danger btn-sm pull-right m-r-15"> <i class="fa fa-download" aria-hidden="true"></i>
                                        Invoice</a>
                            @endif       
                             @if(isset($review) && $order['order_status']==3 && $order['review_apply']==0)
                                <a data-toggle="modal" data-target="#applyReview" class="btn btn-warning btn-sm text-light pull-right m-r-15">Apply Review</a>
                             @endif
                             @if(isset($review) && $order['order_status']==3 && $order['review_apply']==1)
                                <a data-toggle="modal" data-target="#viewReview" class="btn btn-success btn-sm text-light pull-right m-r-15">View Review</a>
                             @endif
                        </div>
                        <div class="card-body">
                             <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xsm-12">
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xsm-12 text-right m-b-15">
                                    <span class="text-muted">{{$order['created_at']}}</span>
                                </div>
                                <div class="col-md-5">
                                    <span class="text-muted"> Name</span>
                                    <h5 class="data-detail"> {{$order['fullname']}}</h5>
                                    <span class="text-muted">Email</span>
                                    <h5 class="data-detail"> {{$order['email']}}</h5>
                                    <span class="text-muted"> Mobile </span>
                                    <h5 class="data-detail"> {{$order['contact_no']}}</h5>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-muted">Address</h5>
                                    <p class="data-detail">
                                    {{$order['address']}} <br>
                                    {{$order['city']}} -  {{$order['zipcode']}}<br>
                                    {{$order['country']}} <br>
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <span class="text-success"> 
                                        @if($order['order_status']==0)
                                            <span>Ordered</span>
                                        @elseif($order['order_status']==1)
                                            <span>Packed</span>
                                        @elseif($order['order_status']==2)
                                            <span>Shipped</span>
                                        @elseif($order['order_status']==3)
                                            <span>Delivered</span>
                                        @elseif($order['order_status']==4)
                                            <span>Cancelled</span>
                                        @else
                                            <span>In Process</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-2 ">
                                    <h5  class="text-muted"><b class="text-warning"> Total </b><br>{{$currency}} {{$order['totalprice']}}</h5>
                                    
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="cart-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th class="p-name">Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_qty = 0; $total_sub_price = 0; $i = 0; ?>
                                            @foreach($carts as $row)
                                            <tr>
                                                <td class="cart-pic first-row"><img src="<?php echo asset('/').'public'?>/{{$row['media_url']}}" alt=""></td>
                                                <td class="cart-title first-row">
                                                    <a href="/product-detail/{{$row['product_slug']}}"><h5>{{$row['product_name']}}</h5></a>
                                                    <div class="catagory-name sku">{{$row['product_sku']}}<br>
                                                    <?php 
                                                        if(isset($row['options'])){
                                                            $options = json_decode($row['options']);
                                                            foreach ($options as $option) {
                                                                ?>
                                                                <span>--{{$option->option_title}} = {{$option->option_value}}</span><br>
                                                                <?php
                                                            }
                                                        }   
                                                    ?>
                                                    </div>
                                                </td>
                                                <td class="p-price first-row">{{$currency}} {{$row['price']}}</td>
                                                <td class="qua-col first-row">
                                                    {{$row['qty']}}
                                                </td>
                                                <td class="total-price first-row">
                                                <?php 
                                                    $qty = (int) $row['qty'];
                                                    $price = (int) $row['price'];
                                                    $totalprice = ($qty * $price);
                                                    $total_qty = $total_qty + $qty;
                                                    $total_sub_price =  $total_sub_price + $totalprice;
                                                    $i++;
                                                ?>    
                                                {{$currency}} {{$totalprice}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-left">Total Qty : </td>
                                                <td class="text-right">{{$total_qty}}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-left">Total Price :</td>
                                                <td class="text-right">{{$currency}} {{$total_sub_price}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(isset($review) && $order['order_status']==3 && $order['review_apply']==0)
        @include('review::addreview',['order' =>$order])
    @endif
    @if(isset($review) && $order['order_status']==3 && $order['review_apply']==1)
        @include('review::viewreview',['order' =>$order])
    @endif
@endsection