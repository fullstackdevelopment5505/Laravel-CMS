@extends('layouts.master')
@section('content')
 <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <a href="/product">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="/checkout" method="post" id="checkoutform" class="checkout-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <h5><strong>Personal Details</strong></h5>
                            <div class="col-lg-12">
                                <label for="fir">Fullname<span>*</span></label>
                                <input type="text" name="fullname" value="{{$user['fullname']}}" id="fir">
                            </div>
                             <div class="col-lg-6">
                                <label for="email">Email Address<span>*</span></label>
                                <input type="text" name="email" value="{{$user['email']}}" id="email">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" name="phone" value="{{isset($defaultaddress['contact_no']) ? $defaultaddress['contact_no']: ''}}" id="phone">
                            </div>
                            <h5><strong>Address Details</strong>
                            <button type="button" data-toggle="modal" data-target="#addNewAddress"  class="btn btn-sm btn-primary">Select Address</button>
                            </h5>
                            <div class="col-lg-12">
                                <label for="street">Address<span>*</span></label>
                                <input type="text" name="address" value="{{isset($defaultaddress['address']) ? $defaultaddress['address']: ''}}"  id="address" class="street-first">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City<span>*</span></label>
                                <input type="text" name="city" value="{{isset($defaultaddress['city']) ? $defaultaddress['city']: ''}}"  id="city">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Country<span>*</span></label>
                                <input type="text" name="country" value="{{isset($defaultaddress['country']) ? $defaultaddress['country']: ''}}"  id="city">
                            </div>
                            <div class="col-lg-12">
                                <label for="zip">Postcode<span>*</span></label>
                                <input type="text" name="zipcode" value="{{isset($defaultaddress['zipcode']) ? $defaultaddress['zipcode']: ''}}"  id="zipcode">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    <?php $total_sub_price = 0; $i = 0;$data  = json_encode($carts) ?>
                                    @foreach($carts as $row)
                                    <li class="fw-normal">{{$row['product_name']}} x {{$row['qty']}} <span>
                                        <?php 
                                            $qty = (int) $row['qty'];
                                            $price = (int) $row['price'];
                                            $totalprice = ($qty * $price);
                                            $total_sub_price =  $total_sub_price + $totalprice;
                                            $i++;                                            
                                        ?>    
                                        {{$currency}} {{$totalprice}}
                                    </span></li>                                    
                                    @endforeach
                                    <li class="fw-normal">Subtotal <span>{{$currency}} {{$total_sub_price}}</span></li>
                                    <li class="total-price">Total <span>{{$currency}} {{$total_sub_price}}</span></li>
                                    <input type="hidden" value="{{$data}}" name="carts" />
                                    <input type="hidden" value="{{$total_sub_price}}" name="totalprice" />
                                    <input type="hidden" value="12312323412312" name="payment_id" />
                                </ul>
                                <div class="payment-check">
                                    <div class="form-check">
                                        <input style="height: auto;" class="form-check-input" type="radio" name="payment_type" id="payment_type_cash" value="cash_on_delhivery" checked>
                                        <label class="form-check-label" for="payment_type_cash">
                                            Cash on Delhivery
                                        </label>
                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
<div class="modal fade" id="addNewAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">My Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row address">
            @foreach($addresses as $row)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$row['address_type']}}</h5>
                        <p class="card-text">
                            {{$row['address']}}<br>
                            {{$row['city']}}, {{$row['zipcode']}}<br>
                            {{$row['country']}}
                        </p>
                        <p class="card-text">
                            {{$row['contact_no']}}
                        </p>
                        <a href="javascript:;" onClick="selectAddress({{$row}})" class="btn btn-primary btn-sm">Select</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    function selectAddress(row){
        $("#address").val(row.address);
        $("#phone").val(row.contact_no);
        $("#city").val(row.city);
        $("#country").val(row.country);
        $("#zipcode").val(row.zipcode);
        $("#addNewAddress").modal('hide');
    }
    $("#checkoutform").validate({
        rules: {
            fullname: {
                required: true,
                maxlength: 50
            },email:{
                required: true,
                email: true,
            },phone:{
                required: true,
                digits: true,
            },address:{
                required: true
            },city:{
                required: true
            },country:{
                required: true
            },zipcode:{
                required: true
            },cash_on_delhivery:{
                required: true
            }
        },
        messages: {                             
        },
    })
</script> 
@endsection