@extends('admin.layout.app')
@section('content')
<div>
    @include('admin.layout.sidebar')
    <div class="all-content-wrapper">
        @include('admin.layout.header')
        <div class="traffic-analysis-area">
            <div class="container-fluid">
                <div class="sparkline13-list grid">
                    <div class="header-panel">
                    <div class="sparkline13-hd">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="main-sparkline13-hd">
                                    <h1>Pages</h1>
                                </div>
                            </div>
                            <div class="col-md-3 m-b-15 search">
                                <input type="text" name="serach" id="serach" placeholder="Search"
                                    class="form-control form-control-sm" />
                            </div>
                            <div class="col-md-1 m-b-15 text-right" style="padding-left: 0;">
                                <a href="<?php echo asset('/').'textla/page/create'?>"
                                    class="btn btn-primary btn-sm">Add Page</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="header-panel-body">
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
                        
                        <table class="tree table table-striped table-bordered table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th width="90%" class="sorting" data-sorting_type="asc" data-column_name="page_title"
                                        style="cursor: pointer">Page Title<span id="page_title_icon"></span></th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('admin.part.page_pagination')                           
                            </tbody>
                        </table>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                        <div id="DeleteModal" class="modal fade text-danger" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <!-- Modal content-->
                                <form action="" id="deleteForm" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <p class="text-center">Are You Sure Want To Delete ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <center>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                                                    onclick="formSubmit()">Yes, Delete</button>
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
                                $('#page_title_icon').html('');
                                $('#page_description_icon').html('');
                                $('#meta_tag_title_icon').html('');
                                $('#meta_tag_description_icon').html('');
                            }
                            function fetch_data(page, sort_type, sort_by, query) {
                                $.ajax({
                                    url: "<?php echo asset('/').'textla/page?page='?>" + page + "&sortby=" + sort_by + "&sorttype=" + sort_type + "&query=" + query,
                                    success: function(data) {
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

                            function deleteData(id) {
                                var id = id;
                                var urlstr = "{{url('textla/page/delete?id=')}}";
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
</div>
@endsection