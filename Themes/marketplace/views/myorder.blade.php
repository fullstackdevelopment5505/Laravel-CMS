@extends('layouts.master')
@section('content')
<section class="banner" style="padding:5%;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text">
                    <h1 class="fadeInLeft animated">
                        <h2>My Order</h2>
                    </h1>
                </div>
            </div>
        </div>
    </section>
   

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                @include('layouts.sidebar')
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('status') }}
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('error') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th class="p-name">Name / Address</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_sub_price = 0; $i = 0; ?>
                                @foreach($orders as $row)
                                <tr>
                                    <td class="cart-pic first-row">
                                        <a href="/order-detail/{{$row['order_no']}}">{{$row['order_no']}}</a>
                                    </td>
                                    <td class="cart-title first-row">
                                        <h5>{{$row['fullname']}}</h5>
                                        <div class="catagory-name sku">{{$row['address']}}<br>
                                        {{$row['city']}}, {{$row['zipcode']}}<br>
                                        {{$row['country']}}
                                        </div>
                                    </td>
                                    <td>{{$currency}} {{$row['totalprice']}}</td>
                                    <td>
                                        @if($row['order_status']==0)
                                            <span>Ordered</span>
                                        @elseif($row['order_status']==1)
                                            <span>Packed</span>
                                        @elseif($row['order_status']==2)
                                            <span>Shipped</span>
                                        @elseif($row['order_status']==3)
                                            <span>Delivered</span>
                                        @else
                                            <span>In Process</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
@endsection