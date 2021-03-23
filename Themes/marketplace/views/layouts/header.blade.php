<section class="navigation-wrap start-header start-style">
    <div class="container">
        <div class="row">
            <div class="col-12 header_area">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="/" target="_blank">
                        <img src="<?php echo asset('/').'public'?>/{{$logo}}" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto py-4 py-md-0">
                            <li class="{{ Request::is('/') ? 'active' : '' }} nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a href="/" class="nav-link">Home</a>
                            </li>
                            <li class="{{ Request::is('page/about-us') ? 'active' : '' }} nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="/page/about-us">About</a>
                            </li>
                            @foreach ($categories as $category)
                                <li class="{{ Request::is('product') ? 'active' : '' }} nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="/product?title={{$category['category_name']}}&category={{$category['category_name']}}">{{$category['category_name']}}</a>
                                </li>
                            @endforeach
                            <li class="{{ Request::is('contact') ? 'active' : '' }} nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="/contact">Contact</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
<script>
    function searchParam(event){
        if(event.keyCode == 13 && window.location.pathname != '/product'){
            window.location.href="/product?keyword="+event.target.value;
        }else if(event.keyCode == 13 && window.location.pathname == '/product'){
            fetch_data();
        }
    }
    function fetch_data() {
        var page = 1;
        if($('#hidden_page')){
            page = $('#hidden_page').val();
        }
        var sort_type = "desc"
        if($('#hidden_page')){
           sort_type = $('.sorting').val();
        }
        var query = "";
        if($("#serach")){
            query = $("#serach").val();
        }
        var category = "";
        if($("#hidden_category")){
            category = $("#hidden_category").val();
        }
        var minamount = "";
        if($("#minamount")){
            minamount = $("#minamount").val();
        }
        var maxamount = "";
        if($("#maxamount")){
            maxamount = $("#maxamount").val();
        }
        $.ajax({
            url: "<?php echo asset('/').'product?page='?>" + page +  "&sorttype=" + sort_type + "&keyword=" + query+"&category="+category+"&maxamount="+maxamount+"&minamount="+minamount,
            success: function(data) {
                console.log(data);
                $('#tbody').html('');
                $('#tbody').html(data);
            }
        })
    }
</script>