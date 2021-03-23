
<div class="product-list">
    <div class="row">                 
        @if(sizeof($products) !== 0)
            @foreach($products as $row)
                <div class="col-lg-4 col-sm-6">
                     @include('part.product_data',['row' => $row])
                </div>
            @endforeach
        @else
            <h4 class="text-center">No Data Available</h4>
        @endif
    </div>
</div>
<div class="loading-more">
    <div class="product-show-option">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                @if($products->hasPages())
                    {!! $products->links() !!}
                @endif
            </div>
            <div class="col-lg-5 col-md-5 text-right">
                <p>Show 
                @if($products->onFirstPage())
                1 
                @else
                {{ (($products->perPage() * ($products->currentPage() - 1)) + 1) }}
                @endif
                -
                @if($products->onFirstPage())   
                    @if($products->perPage() > $products->total())       
                        {{$products->total()}}
                    @else
                        {{$products->perPage()}}
                    @endif
                @else
                    {{($products->perPage() * $products->currentPage())}}
                @endif
                 Of {{$products->total()}} Product</p>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="{{ themes('js/jquery.nice-select.min.js') }}"></script>
<script>
    $(document).ready(function() {
        
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data();
        });
        $(document).on('change', '.sorting', function(event) {
            event.preventDefault();
            $('#hidden_page').val(1);
            fetch_data();
        });
        $('#treeList :checkbox').change(function (){
            $(this).siblings('ul').find(':checkbox').prop('checked', this.checked);
            if (this.checked) {
            $(this).parentsUntil('#treeList', 'ul').siblings(':checkbox').prop('checked', true);
                } else {
                    $(this).parentsUntil('#treeList', 'ul').each(function(){
                        var $this = $(this);
                        var childSelected = $this.find(':checkbox:checked').length;
                        if (!childSelected) {
                            $this.prev(':checkbox').prop('checked', false);
                        }
                    });
                }
        });
        $('#treeList :checkbox').change(function (){
            var categoryId = [];
            $(".category_filter").each(function(){
                if($(this).prop('checked')){
                    categoryId.push($(this).attr('category'));
                }
            })
            $("#hidden_category").val(categoryId.join("ˆ"));
            fetch_data();
        })
        $(document).on('click', '.filter_apply', function(event) {
            event.preventDefault();
            fetch_data();
        });
        $(document).on('click', '.clear_all', function(event) {
            event.preventDefault();
            window.location.href="/product";
        });
    })
</script>