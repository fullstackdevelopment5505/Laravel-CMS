<div class="product-item">
    {{ csrf_field() }}
    <div class="pi-pic">
        <img src="<?php echo asset('/').'public'?>/{{$row['media_url']}}" alt="">
        @if($row['on_sale'] == 1)
            <div class="sale">Sale</div>
        @endif
        @if($auth_status) 
            <div class="icon">
                <i onClick="addToWishlist({{$row}})" class="icon_heart_alt"></i>
            </div>
        @else 
            <div class="icon">
                <a href="/login?redirect=product-detail/{{$row['product_slug']}}"><i class="icon_heart_alt"></i></a>
            </div>
        @endif
        <ul>
            <li class="w-icon active"><a onClick="addToCart({{$row}})" href="javascript:;"><i class="icon_bag_alt"></i></a></li>
            <li class="quick-view"><a href="/product-detail/{{$row['product_slug']}}">+ Quick View</a></li>
        </ul>
    </div>
    <div class="pi-text">
        <div class="catagory-name">{{$row['product_sku']}}</div>
        <a href="/product-detail/{{$row['product_slug']}}">
            <h5>{{$row['product_name']}}</h5>
        </a>
        @if(isset($row['discount_price']) && $row['discount_price'] != '0')
            <div class="product-price price">
                {{$currency}}{{$row['discount_price']}}{{$currType}}
                <span class="price">{{$currency}}{{$row['total_cost']}}{{$currType}}</span>
            </div>
        @else
            <div class="product-price price">
                {{$currency}}{{$row['total_cost']}}{{$currType}}
            </div>
        @endif
    </div>
</div>
<script>
    function addToCart(row){
        let price = (row.discount_price != 0 ? row.discount_price : row.total_cost);
        let cart = {
            'ref_id': getCookie('current-uuid'),
            'product_id': row.id,
            'qty': 1,
            'price': price,
            'options':""
        }
        $.ajax({
            url: "<?php echo asset('/').'addtocart'?>",
            type: "post",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
            },
            data: JSON.parse(JSON.stringify(cart)),
            success: function(data) {
                $.alert({
                    title: 'Success',
                    content: 'Cart item added successfully',
                });
                $("#cart_count").html(data.count);
            }
        })
    }
    function addToWishlist(row){
        let cart = {
            'product_id': row.id
        }
        $.ajax({
            url: "<?php echo asset('/').'addtowishlist'?>",
            type: "post",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
            },
            data: JSON.parse(JSON.stringify(cart)),
            success: function(data) {
                $.alert({
                    title: 'Success',
                    content: data.message,
                });
                $("#wishlist_count").html(data.count);
            }
        })
    }
</script>