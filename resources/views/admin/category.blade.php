
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
                                                    <h1>Category</h1>
                                                </div>
                                            </div>
                                            <div class="col-md-3 m-b-15 text-right">
                                                <a href="<?php echo asset('/').'textla/category/create'?>" class="btn btn-primary btn-sm">Create</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="header-panel-body">
                                <div class="sparkline13-graph">     
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
                                   <table class="tree table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="60%">Category Name</th>
                                                <th width="10%">Image</th>
                                                <th width="30%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                                <tr class="treegrid-{{$category->id}}">
                                                    <td>{{ $category->category_name }}</td>
                                                    <td><img src="<?php echo asset('/').'public'?>/{{$category->media_url}}" class="category-image img-responsive img-fluid" ></td>
                                                    <td>
                                                        <a href="<?php echo asset('/').'textla/category/update?id='?>{{ $category->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$category->id}})" data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @if(count($category->children))
                                                    @include('admin.part.manage_child',['childs' => $category->children])
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                                    <script>
                                        function formSubmit()
                                        {
                                            $("#deleteForm").submit();
                                        }
                                        function deleteData(id)
                                        {
                                            var id = id;
                                            var urlstr = "{{url('textla/category/delete?id=')}}";
                                            urlstr = urlstr+id;
                                            $("#deleteForm").attr('action', urlstr);
                                        }
                                        $(document).ready(function() {
                                            $('.tree').treegrid().treegrid('collapseAll');
                                        });
                                         window.setTimeout(function() {
                                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
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
            </div>
        </div>
    </div>
@endsection
