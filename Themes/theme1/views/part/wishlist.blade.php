@if(sizeof($wishlists) !== 0)
<div class="row" id="wishlist-data">
                    
@foreach($wishlists as $row)
    <div class="col-lg-4 col-sm-6">
        @include('part.wishlist_product_data',['row' => $row])
    </div>
@endforeach
</div>
@else
<div class="text-center">
    <h4 >No Data Available</h4>
</div>
@endif