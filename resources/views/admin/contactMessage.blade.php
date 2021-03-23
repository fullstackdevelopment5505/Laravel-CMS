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
                                    <h1>Messages</h1>
                                </div>
                            </div>
                            <div class="col-md-3 m-b-15 search">
                                <input type="text" name="serach" id="serach" placeholder="Search"
                                    class="form-control form-control-sm" />
                            </div>
                            <div class="col-md-1 m-b-15 text-right" style="padding-left: 0;">
                                <a href="<?php echo asset('/').'textla/dashboard'?>"
                                    class="btn btn-primary btn-sm">Home</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="header-panel-body">
                                               
                        <table class="tree table table-striped table-bordered table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th width="20%" class="sorting" data-sorting_type="asc" data-column_name="contact_name"
                                        style="cursor: pointer">Name<span id="contact_name_icon"></span></th>
                                    <th width="20%" class="sorting" data-sorting_type="asc" data-column_name="contact_email"
                                        style="cursor: pointer">Email<span id="contact_email_icon"></span></th>
                                    <th width="50%" class="sorting" data-sorting_type="asc" data-column_name="message"
                                        style="cursor: pointer">Message<span id="message_icon"></span></th>
                                    <th width="10%" class="sorting" data-sorting_type="asc" data-column_name="created_at"
                                        style="cursor: pointer">Date<span id="created_at_icon"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('admin.part.contact_message_pagination')  
                            </tbody>
                        </table>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                      
                        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                        <script>
                        $(document).ready(function() {
                            function clear_icon() {
                                $('#contact_name_icon').html('');
                                $('#contact_email_icon').html('');
                                $('#message_icon').html('');
                                $('#created_at_icon').html('');
                               
                            }
                            function fetch_data(page, sort_type, sort_by, query) {
                                $.ajax({
                                    url: "<?php echo asset('/').'textla/contactMessage?page='?>" + page + "&sortby=" + sort_by + "&sorttype=" + sort_type + "&query=" + query,
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