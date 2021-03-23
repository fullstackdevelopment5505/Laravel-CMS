@extends('admin.layout.app')
@section('content')
    <div>
        @include('admin.layout.sidebar')
        <div  class="all-content-wrapper">
            @include('admin.layout.header')
            <div class="data-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline13-list grid">
                                <div class="header-panel">
                                    <div class="sparkline13-hd">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="main-sparkline13-hd">
                                                    <h1>Users</h1>
                                                </div>
                                            </div>
                                            <div class="col-md-3 m-b-15 search">
                                                <input type="text" name="serach" id="serach" placeholder="Search" class="form-control form-control-sm" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-panel-body">
                                    <div class="sparkline13-graph">                                
                                        <div class="datatable-dashv1-list custom-datatable-overright">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="10%" class="sorting" data-sorting_type="asc" data-column_name="memberid" style="cursor: pointer">ID <span id="memberid_icon"></span></th>
                                                        <th width="30%" class="sorting" data-sorting_type="asc" data-column_name="fullname" style="cursor: pointer">Title <span id="fullname_icon"></span></th>
                                                        <th width="30%" class="sorting" data-sorting_type="asc" data-column_name="email" style="cursor: pointer">Email <span id="email_icon"></span></th>
                                                        <th width="20%" class="sorting" data-sorting_type="asc" data-column_name="country" style="cursor: pointer">Country <span id="country_icon"></span></th>
                                                        <th width="10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @include('admin.part.user_pagination')
                                                </tbody>
                                            </table>
                                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                                            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                                        </div>
                                        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                                        <script>
                                            $(document).ready(function() {
                                                function clear_icon() {
                                                    $('#memberid_icon').html('');
                                                    $('#fullname_icon').html('');
                                                    $('#email_icon').html('');
                                                    $('#country_icon').html('');
                                                }
                                                function fetch_data(page, sort_type, sort_by, query) {
                                                    $.ajax({
                                                        url: "/admin/users?page=" + page + "&sortby=" + sort_by + "&sorttype=" + sort_type + "&query=" + query,
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
                                                        $('#' + column_name + '_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
                                                    }
                                                    if (order_type == 'desc') {
                                                        $(this).data('sorting_type', 'asc');
                                                        reverse_order = 'asc';
                                                        $('#' + column_name + '_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
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
                                                $(document).on('click', '.view_user', function(event){
                                                    view_profile($(this).attr("id"));
                                                })
                                                function view_profile(userId) {
                                                    $.ajax({
                                                        url: "/admin/user/profile?userId=" + userId,
                                                        success: function(data) {
                                                        $("#viewProfileModal").modal();
                                                        $('#view-profile-body').html('');
                                                        $('#view-profile-body').html(data);
                                                        }
                                                    })
                                                }
                                            });
                                        </script>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="viewProfileModal" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" id="view-profile-body">
                       
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
