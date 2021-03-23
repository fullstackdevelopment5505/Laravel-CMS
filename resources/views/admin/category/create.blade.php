
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
                            <div class="sparkline13-list">
                                <div class="sparkline13-hd">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="main-sparkline13-hd">
                                                <h1>Create Category</h1>
                                            </div>
                                        </div>
                                        <div class="col-md-3 m-b-15 text-right">
                                           <a href="{{url('textla/category')}}" class="btn btn-primary  btn-sm">Back</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="modal fade" data-backdrop="static" data-keyboard="false"  id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalTitle">Media</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div class="row">
                                            @foreach ($medias as $media)
                                            @if($media->file_type == 'png' || $media->file_type == 'jpg' || $media->file_type == 'jpeg')
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                    <a href="javascript:;" filepath='{{$media->media_url}}' data='{{$media}}' class="file-preview">
                                                            <img src="<?php echo asset('/').'public'?>/{{$media->media_url}}" class="category-image img-responsive img-fluid media-img" >
                                                        </a>
                                                    </div>            
                                                    @endif
                                            @endforeach 
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onClick="selectMedia()">Select</button>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="sparkline13-graph">  
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('warning'))
                                        <div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            {{ session('warning') }}
                                        </div>
                                    @endif
                                    @if($errors->any())
                                        {!! implode('', $errors->all('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!&nbsp; </strong>:message</div>')) !!}
                                    @endif                              
                                    <form  action="{{url('textla/category/post-create')}}" method="post" id="category_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label" for="password">Select Category</label>
                                                    <select name="parent_id" id="parent_id" class="form-control form-control-sm">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label" for="username">Category Name <i class="fa fa-asterisk error"></i></label>
                                                    <input type="text" placeholder="Category Name" value="" name="category_name" id="category_name" class="form-control form-control-sm">
                                                    @if ($errors->has('category_name'))
                                                        <span class="help-block small error text-danger">{{ $errors->first('category_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <a onClick="openModel()">
                                                    <img id="output" src="https://placehold.it/80x80" class="img-preview img-thumbnail img-fluid"/>
                                                    <input type="text" style="opacity: 0;position: absolute;bottom: 25px;" placeholder="Category Name" value="" name="media_id" id="media_id" class="form-control form-control-sm">
                                                </a>
                                            </div>
                                            
                                            
                                            <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
                                            <script>
                                                window.setTimeout(function() {
                                                     $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                                        $(this).remove();
                                                    });
                                                }, 3000);
                                                 $("#category_form").validate({
                                                    rules: {
                                                        category_name: {
                                                            required: true,
                                                            maxlength: 50
                                                        },                                        
                                                        media_id: {
                                                            required: true
                                                        }
                                                    },
                                                    messages: {
                                                        category_name: {
                                                            required: "This field is required",
                                                        },
                                                        media_id: {
                                                            required: "This field is required",
                                                        }                                        
                                                    },
                                                })
                                                var loadFile = function(event) {
                                                    var reader = new FileReader();
                                                    reader.onload = function(){
                                                    var output = document.getElementById('output');
                                                    output.src = reader.result;
                                                    };
                                                    reader.readAsDataURL(event.target.files[0]);
                                                };
                                                
                                                function openModel(){
                                                    $("#mediaModal").modal();
                                                    $(".file-preview").click(function () {
                                                        $(".file-preview").each(function () {
                                                            $(this).removeClass("selected")
                                                        });
                                                        $(this).toggleClass("selected");
                                                    })
                                                }
                                                function selectMedia(){
                                                     $(".file-preview").each(function () {
                                                        if ($(this).hasClass("selected")) {
                                                            let data = JSON.parse($(this).attr('data'));
                                                            $("#output").attr('src', '<?php echo asset('/').'public'?>/'+data.media_url);
                                                            $("#media_id").val(data.id);
                                                            $("#mediaModal").modal('hide');
                                                        }
                                                    })
                                                }
                                               
                                            </script>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button class="btn btn-success btn-sm" type="submit">Submit</button>
                                                <button class="btn btn-primary btn-sm" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
