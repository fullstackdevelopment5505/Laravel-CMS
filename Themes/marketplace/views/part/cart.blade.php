<div class="col-lg-12">
@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('status') }}
    </div>
@endif 
@if (isset($status))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ $status }}
    </div>
@endif  
<div class="cart-table">
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th class="p-name">Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th><i class="ti-close"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php $total_sub_price = 0; $i = 0; ?>
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
                <td class="p-price first-row">{{$currency}} {{$row['price']}}{{$currType}}</td>
                <td class="qua-col first-row">
                    <div class="quantity">
                        <div class="pro-qty" cart-id="{{$row['id']}}">
                            <input type="text" class="qty_text" id="qty_text{{$i}}" value="{{$row['qty']}}" onChange="updateQuntity()">
                        </div>
                    </div>
                </td>
                <td class="total-price first-row">
                <?php 
                    $qty = (int) $row['qty'];
                    $price = (int) $row['price'];
                    $totalprice = ($qty * $price);
                    $total_sub_price =  $total_sub_price + $totalprice;
                    $i++;
                ?>    
                {{$currency}} {{$totalprice}}{{$currType}}</td>
                <td class="close-td first-row" onClick="deleteCartItem({{$row}})"><i class="ti-close"></i></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="cart-buttons">
            <a href="/product" class="primary-btn continue-shop">Continue shopping</a>
        </div>
    </div>
    <div class="col-lg-4 offset-lg-4">
        <div class="proceed-checkout">
            <ul>
                <li class="subtotal">Subtotal <span>{{$currency}} {{$total_sub_price}}{{$currType}}</span></li>
                <li class="cart-total">Total <span>{{$currency}} {{$total_sub_price}}{{$currType}}</span></li>
            </ul>
            @if ($auth_status)
                <a href="/checkout" class="proceed-btn">PROCEED TO CHECK OUT</a>
            @else
                <a href="/login?redirect=checkout" class="proceed-btn">PROCEED TO CHECK OUT</a>
            @endif
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
    function deleteCartItem(row){
        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure you want to delete cart item!',
            buttons: {
                confirm: function () {
                    window.location.href="/deletecartitem?id="+row.id;
                },
                cancel: function () {
                    $.alert('Canceled!');
                }
            }
        });
    }
    function updateQuntity(qty, cartid){
        if(qty && cartid){
            $.ajax({
                url: "<?php echo asset('/').'updatecartqty'?>?cartId="+cartid+"&qty="+qty,
                type: "get",
                success: function(data) {
                    console.log(data);
                    $("#cart-data").html("");
                    $("#cart-data").html(data);
                }
            })
        }
    }
    $(document).ready(function(){
        $(".qtybtn").click(function(){
            setTimeout(() => {
                let qty = $(this).parent().children('input').val();
                let cartId = $(this).parent().attr("cart-id");
                updateQuntity(qty, cartId);
            }, 100);
        })  
        $(".qty_text").change(function(){
            let qty = $(this).parent().children('input').val();
            let cartId = $(this).parent().attr("cart-id");
            updateQuntity(qty, cartId);
        })
    })
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3000);
</script>