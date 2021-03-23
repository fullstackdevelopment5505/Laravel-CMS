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
                                    <h1>Orders</h1>
                                </div>
                            </div>
                            <div class="col-md-3 m-b-15 text-right">
                                <a href="<?php echo asset('/').'textla/dashboard'?>"
                                    class="btn btn-primary btn-sm">Home</a>
                            </div>
                        </div>

                    </div>
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
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3 m-b-15">
                            <input type="text" name="serach" id="serach" placeholder="Search"
                                class="form-control form-control-sm" />
                        </div>
                    </div>
                    <table class="tree table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th width="20%" class="sorting" data-sorting_type="asc" data-column_name="order_no"
                                    style="cursor: pointer">Order ID<span id="order_no_icon"></span></th>
                                <th width="25%" class="sorting" data-sorting_type="asc" data-column_name="fullname"
                                    >Customer Name<span id="fullname_icon"></span></th>
                                <th width="10%" data-sorting_type="asc" data-column_name="total_amount">Total Amount
                                <span id="total_amount_icon"></span></th>
                                <th width="15%" class="sorting" data-sorting_type="asc" data-column_name="created_at"
                                    style="cursor: pointer">Order Created
                                    <span id="created_at_icon"></span></th>
                                <th width="15%"  class="sorting" data-sorting_type="asc" data-column_name="updated_at"  style="cursor: pointer" >Order Updated
                                <span id="updated_at_icon"></span></th>
                                <th width="5%">Status</th>
                                <th width="5%">View</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @include('admin.part.order_pagination')
                        </tbody>
                    </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                    <div id="DeleteModal" class="modal fade text-danger" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <form action="" id="deleteForm" method="post">
                              {{ csrf_field() }}
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title text-center">CANCEL CONFIRMATION</h4>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <p class="text-center">Are You Sure Want To Cancel This Order ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <center>
                                            <button type="button" class="btn btn-success"
                                                data-dismiss="modal">Back</button>
                                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                                                onclick="formSubmit()">Yes, Cancel</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                     <script>
                        $(document).ready(function() {
                            function clear_icon() {
                                $('#order_no_icon').html('');
                                $('#fullname_icon').html('');
                                $('#created_at_icon').html('');
                                $('#updated_at_icon').html('');
                            }
                            function fetch_data(page, sort_type, sort_by, query) {

                                //alert(page + sort_type + sort_by + query)
                                $.ajax({
                                    url: "<?php echo asset('/').'textla/orderlist?page='?>" + page + "&sortby=" + sort_by + "&sorttype=" + sort_type + "&query=" + query,
                                    success: function(data) {
                                        console.log(data);
                                        $('tbody').html('');
                                        $('tbody').html(data);
                                    }
                                })
                            }
                            $(document).on('keyup', '#serach', function() {

                                var query = $('#serach').val();
                                var column_name = $('#hidden_column_name').val();
                                var sort_type = $('#hidden_sort_type').val();
                                var page = $('#hidden_page').val();
                                fetch_data(page, sort_type, column_name, query);
                            });
                            $(document).on('click', '.sorting', function() {
                                var column_name = $(this).data('column_name');
                                var order_type = $(this).data('sorting_type');
                                var reverse_order = '';
                                clear_icon();
                                if (order_type == 'asc') {
                                    $(this).data('sorting_type', 'desc');
                                    reverse_order = 'desc';
                                    $('#' + column_name + '_icon').html(
                                        '<span class="glyphicon glyphicon-triangle-bottom"></span>');
                                }
                                if (order_type == 'desc') {
                                    $(this).data('sorting_type', 'asc');
                                    reverse_order = 'asc';
                                    $('#' + column_name + '_icon').html(
                                        '<span class="glyphicon glyphicon-triangle-top"></span>');
                                }
                                $('#hidden_column_name').val(column_name);
                                $('#hidden_sort_type').val(reverse_order);
                                var page = $('#hidden_page').val();
                                var query = $('#serach').val();
                                fetch_data(page, reverse_order, column_name, query);
                            });

                            $(document).on('click', '.pagination a', function(event) {
                                event.preventDefault();
                                var page = $(this).attr('href').split('page=')[1];
                                $('#hidden_page').val(page);
                                var column_name = $('#hidden_column_name').val();
                                var sort_type = $('#hidden_sort_type').val();

                                var query = $('#serach').val();

                                $('li').removeClass('active');
                                $(this).parent().addClass('active');
                                fetch_data(page, sort_type, column_name, query);
                            });


                        });
                    </script>

                    <script>
                        function formSubmit() {   
                            $("#deleteForm").submit();   
                                                     
                        }
                        function deleteData(order_no) {   
                            console.log(order_no)                         
                            var id = order_no;
                            var urlstr = "{{url('textla/orderlist/ordercancel?id=')}}";
                            urlstr = urlstr + id;                            
                            $("#deleteForm").attr('action', urlstr);
                        }

                        $(document).ready(function() {
                            $('.tree').treegrid().treegrid('collapseAll');
                        });
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                $(this).remove();
                            });
                        }, 3000);
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection