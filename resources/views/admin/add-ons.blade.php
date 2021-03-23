@extends('admin.layout.app')
@section('content')
<div>
    @include('admin.layout.sidebar')
    <div class="all-content-wrapper">
        @include('admin.layout.header')
        <div class="traffic-analysis-area">
            <div class="container-fluid">
                <div class="sparkline13-list">
                <div class="header-panel">
                    <div class="sparkline13-hd">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="main-sparkline13-hd">
                                    <h1>Add-ons</h1>
                                </div>
                            </div>
                            <div class="col-md-3 m-b-15 text-right">
                                <a href="<?php echo asset('/').'textla/dashboard'?>"
                                    class="btn btn-primary btn-sm">Home</a>
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
                                <th width="80%" class="sorting" data-sorting_type="asc" data-column_name="product_name"
                                    style="cursor: pointer">Addon Name<span id="product_name_icon"></span></th>
                                <th width="20%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('admin.part.addons')
                        </tbody>
                    </table>                  
                </div>
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>                                            
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script type="text/javascript" language="javascript">
                $(document).ready(function() {
                    $(".status-button").click(function() {
                        var id = $(this).attr('id');
                        var status = $(this).attr('val');
                        set_value(id,status);
                    });                              
                    function set_value(id,value) {  
                        $.ajax({
                            url: "<?php echo asset('/').'textla/add-ons/activate?id='?>" + id + "&value=" + value,
                            success: function(data) {                                     
                                location.reload(true);
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
@endsection