@extends('layouts.master')
@section('content')
 {{ csrf_field() }}
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <a href="/product">Shop</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="<?php echo asset('/').'public'?>/{{$product['media_url']}}" alt="">
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    <?php $count = 0; ?>
                                    @foreach($product_images as $row)
                                        @if($count == 0)
                                            <div class="pt active" data-imgbigurl="<?php echo asset('/').'public'?>/{{$row['media_url']}}"><img
                                                    src="<?php echo asset('/').'public'?>/{{$row['media_url']}}" alt=""></div>
                                        @else
                                            <div class="pt" data-imgbigurl="<?php echo asset('/').'public'?>/{{$row['media_url']}}"><img
                                                    src="<?php echo asset('/').'public'?>/{{$row['media_url']}}" alt=""></div>
                                        @endif
                                        <?php $count++; ?>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{$product['product_name']}}</span>
                                    <h3>{{$product['product_name']}}</h3>
                                    @if($auth_status) 
                                        <a href="javascript:;" class="heart-icon"><i  onClick="addToWishlist({{$product}})" class="icon_heart_alt"></i></a>
                                    @else 
                                        <a class="heart-icon" href="/login?redirect=product-detail/{{$product['product_slug']}}"><i class="icon_heart_alt"></i></a>
                                    @endif
                                </div>
                                <div class="pd-desc">
                                    @if(isset($product['discount_price']) && $product['discount_price'] != '0')
                                        <input type="hidden" value="{{$product['discount_price']}}" id="actual_price"/>
                                        <h4>{{$currency}}<strong class="price_value">{{$product['discount_price']}}</strong> <span>{{$currency}}{{$product['total_cost']}}</span></h4>
                                    @else
                                        <input type="hidden" value="{{$product['total_cost']}}" id="actual_price"/>
                                        <h4>{{$currency}}<strong class="price_value">{{$product['total_cost']}}</strong></h4>
                                    @endif
                                </div>
                                @if(isset($productcolor))
                                 <?php $options_color = json_decode($productcolor['options_values']) ?>
                                <div class="pd-color">
                                    <h6>Color</h6>
                                    <div class="pd-color-choose">
                                        @foreach($options_color as $opt)
                                            <?php $count = 0; $data = json_encode($opt); ?>
                                            <div class="cc-item">
                                                <input type="radio" value="{{$opt->option_value}}" name="color" id="cc-black">
                                                <label class="sm-color" for="cc-{{$opt->option_value}}" style="background:{{$opt->option_value}}" price-delimitor="{{$opt->price_inc_dec_delemeter}}" price="{{$opt->price}}" value="{{$opt->option_value}}"  quantity="{{$opt->option_quantity}}"></label>
                                            </div>
                                        <?php $count++ ?>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if(isset($productsize))
                                <?php $options = json_decode($productsize['options_values']) ?>
                                <div class="pd-size-choose">
                                    @foreach($options as $opt)
                                    <?php $count = 0; $data = json_encode($opt); ?>
                                    <div class="sc-item">
                                        <input type="radio" name="size" value="{{$opt->option_value}}" data-json="{{$data}}" id="sm-size{{$count}}">
                                        <label class="sm-size" for="sm-size" price-delimitor="{{$opt->price_inc_dec_delemeter}}" price="{{$opt->price}}" value="{{$opt->option_value}}"  quantity="{{$opt->option_quantity}}">
                                            {{$opt->option_value}}
                                        </label>
                                    </div>
                                    <?php $count++ ?>
                                    @endforeach
                                </div>  
                                @endif
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" id="qty" value="1">
                                    </div>
                                    <a href="javascript:;" onClick="addToCart({{$product}})" class="primary-btn pd-cart" >Add To Cart</a>
                                </div>
                                <ul class="pd-tags">
                                    <li><span>CATEGORIES</span>: {{$product_category}}</li>
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code">Sku : {{$product['product_sku']}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                                </li>
                                <!-- <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews ({{sizeof($productreview)}})</a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <?php echo($product['product_description']);?>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">
                                                       @for ($i = 0; $i < 5; ++$i)
                                                        <i class="fa fa-star{{ $avgrating<=$i?'-o':'' }}" aria-hidden="true"></i>
                                                        @endfor
                                                        <span>({{$avgrating}})</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price">
                                                        {{$currency}}
                                                        <strong class="price_value">{{$product['total_cost']}}</strong>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock">{{$product['product_out_of_stock_status']}}</div>
                                                </td>
                                            </tr>
                                            @if(isset($productsize))
                                            <tr>
                                                <td class="p-catagory">Size</td>
                                                <td>
                                                    <div class="p-stock" id="stock_size">S</div>
                                                </td>
                                            </tr>
                                            @endif
                                            @if(isset($productcolor))
                                            <tr>
                                                <td class="p-catagory">Color</td>
                                                <td>
                                                    <div class="p-stock" id="stock_color">Black</div>
                                                </td>
                                            </tr>
                                            @endif
                                             <tr>
                                                <td class="p-catagory">Sku</td>
                                                <td>
                                                    <div class="p-code">{{$product['product_sku']}}</div>
                                                </td>
                                            </tr>                                           
                                        </table>
                                    </div>
                                </div>
                                <!-- Comments code here -->
                                <!-- <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{sizeof($productreview)}} Comments</h4>
                                        <div class="comment-option">
                                        @foreach($productreview as $review)
                                            <div class="co-item">
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                    @for ($i = 0; $i < 5; ++$i)
                                                        <i class="fa fa-star{{ $review->rating_star<=$i?'-o':'' }}" aria-hidden="true"></i>
                                                    @endfor
                                                    </div>
                                                    <h5>{{$review['fullname']}} <span>{{$review['created_at']}}</span></h5>
                                                    <div class="at-reply">{{$review['review_comment']}}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                        @if($auth_status)
                                            <div class="leave-comment">
                                                <h4>Leave A Comment</h4>
                                                <form action="#" class="comment-form">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input type="text" placeholder="Name">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="text" placeholder="Email">
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <textarea placeholder="Messages"></textarea>
                                                            <button type="submit" class="site-btn">Send message</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    @if(sizeof($relatedproduct) != 0)
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($relatedproduct as $row)
                <div class="col-lg-3 col-sm-6">
                     @include('part.product_data',['row' => $row])
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
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
        function addToCart(row){
            if(parseInt($("#qty").val()) > 0){
                let option = []
                if($(".sm-size").length != 0){
                    option.push({
                        option_title: "size",
                        option_value:$(".sm-size.active").attr("value")
                    })
                }
                if($(".sm-color").length != 0){
                    option.push({
                        option_title: "size",
                        option_value: $(".sm-color.active").attr("value")
                    })
                }
                let cart = {
                    'ref_id': getCookie('uuid'),
                    'product_id': row.id,
                    'qty': parseInt($("#qty").val()),
                    'price': $(".price_value").html(),
                    'options':JSON.stringify(option)
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
            }else{

            }
        }
        function getColorPrice(){
            if($(".sm-color").length != 0){
                let delimitor = $(".sm-color.active").attr("price-delimitor");
                let price = $(".sm-color.active").attr("price");
                let quantity = $(".sm-color.active").attr("quantity"); 
                let value = $(".sm-color.active").attr("value"); 
                $("#stock_color").html(value);
                price = price ? parseInt(price) : 0
                let actual_price = parseInt($(".price_value").html());
                let total = 0;
                if(delimitor == '+'){
                    total = actual_price + price;
                }else{
                    total = actual_price - price;
                }
                total;
                $(".price_value").html(total);
            }
            return 0;
        }
        function getSizePrice(){
            if($(".sm-size").length != 0){
                let delimitor = $(".sm-size.active").attr("price-delimitor");
                let price = $(".sm-size.active").attr("price");
                let quantity = $(".sm-size.active").attr("quantity"); 
                let value = $(".sm-size.active").attr("value"); 
                $("#stock_size").html(value);
                price = price ? parseInt(price) : 0
                let actual_price = parseInt($("#actual_price").val());
                let total = 0;
                if(delimitor == '+'){
                    total = actual_price + price;
                }else{
                    total = actual_price - price;
                }
                $(".price_value").html(total);
            }
        }
        function init(){
            getSizePrice();
            getColorPrice();
        }
        $(document).ready(function(){
            if($(".sm-size").length != 0){
                $(".sm-size").first().addClass("active");
                init();
            }
            if($(".sm-color").length != 0){
                $(".sm-color").first().addClass("active");
                init();
            }
            $(".sm-size").click(function(){
                init();
            })
            $(".sm-color").click(function(){
                $(".sm-color").removeClass('active');
                $(this).addClass("active");
                init();
            })
        })
        
    </script>
@endsection