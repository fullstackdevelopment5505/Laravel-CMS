@extends('admin.layout.app')
@section('content')
    <div>
        @include('admin.layout.sidebar')
        <div  class="all-content-wrapper">
        @include('admin.layout.header')
             <div class="traffic-analysis-area">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="breadcome-heading">
                            <h3>Media <a href="javascript:;" id="addnewmedia" class="btn btn-primary btn-sm">Add Media</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      {{ csrf_field() }}
                    </div>             
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div id="imageUpload" class="dropzone"></div>
                    </div>
                </div>
                <div class="row" id="fileslist">
                    @foreach ($medias as $media)
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <a href="javascript:;" onClick="viewMedia({{$media}})">
                            @if($media->file_type == 'png' || $media->file_type == 'jpg' || $media->file_type == 'jpeg')
                                <img src="<?php echo asset('/').'public'?>/{{$media->media_url}}" class="category-image img-responsive img-fluid media-img" >
                            @else
                                <img src="<?php echo asset('/').'public'?>/default/file.png" class="category-image img-responsive img-fluid media-img" >
                            @endif
                        </a>
                    </div>            
                    @endforeach 
                </div>
            </div>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
            <script src="<?php echo asset('/').'public'?>/admin/js/vendor/jquery-1.12.4.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
            <script>
                function viewMedia(data){
                    console.log(data);
                }
                function validate(formData, jqForm, options) {
                    var form = jqForm[0];
                    if (!form.file.value) {
                        alert('File not found');
                        return false;
                    }
                }
                $(document).ready(function(){
                    $("#addnewmedia").click(function(){
                        $("#dropzone").toggle();
                    });
                });
                Dropzone.autoDiscover = false;
                myDropzone = new Dropzone('div#imageUpload', {
                    addRemoveLinks: true,
                    autoProcessQueue: true,
                    uploadMultiple: true,
                    parallelUploads: 100,
                    maxFiles: 5,
                    paramName: 'file',
                    clickable: true,
                    headers: {
                        'X-CSRF-TOKEN':$('[name="_token"]').val()
                    },
                    url: "{{url('cms_admin/media/upload')}}",
                    init: function () {
                        var myDropzone = this;
                        myDropzone.processQueue();
                        this.on("complete", function(file) { 
                            this.removeAllFiles(true); 
                        })
                        this.on('sending', function(file, xhr, formData){
                            // xhr.setRequestHeader('X-CSRF-Token', "");
                            // xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
                        })
                    },
                    error: function (file, response){
                        if ($.type(response) === "string")
                            var message = response; //dropzone sends it's own error messages in string
                        else
                            var message = response.message;
                        file.previewElement.classList.add("dz-error");
                        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                        _results = [];
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            node = _ref[_i];
                            _results.push(node.textContent = message);
                        }
                        return _results;
                    },
                    successmultiple: function (file, response) {
                        let res = "";
                        for (const item of response) {
                            res += '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">';
                            res += '<a href="javascript:;" onClick="viewMedia('+item+')">';
                            if(item.file_type == 'png' || item.file_type == 'jpg' || item.file_type == 'jpeg'){
                                res += '<img src="<?php echo asset('/').'public'?>/'+item.media_url+'" class="category-image img-responsive img-fluid media-img" >';
                            }else{
                                res += '<img src="<?php echo asset('/').'public'?>/default/file.png" class="category-image img-responsive img-fluid media-img" >';
                            }
                            res += '</a>';
                            res += '</div>';
                        }
                        $("#fileslist").html(res);
                    },
                    completemultiple: function (file, response) {
                        console.log(response)
                    },
                    reset: function () {
                    }
                });
            </script>
        </div>
    </div>
@endsection