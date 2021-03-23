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
                <br>
                
                <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                                    Media</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                          <div class="panel-body">
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
                    <div class="row" id="fileslist">
                        @foreach ($medias as $media)
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 form-group">
                            <a href="javascript:;" filepath='{{$media->media_url}}' data='{{$media}}' class="file-preview">
                                @if($media->file_type == 'png' || $media->file_type == 'jpg' || $media->file_type == 'jpeg')
                                    <img src="<?php echo asset('/').'public'?>/{{$media->media_url}}" class="category-image img-responsive img-fluid media-img" >
                                    
                                @else
                                    <img src="<?php echo asset('/').'public'?>/default/file.png" class="category-image img-responsive img-fluid media-img" >
                                   
                                @endif
                            <a href="javascript:;" id="{{$media->id}}"  pathval="{{$media->media_url}}" class="imgRemove btn btn-xs btn-danger form-control" style="margin-top:-15px;"><i class="fa fa-trash"></i></a>
                            </a>
                        </div>            
                        @endforeach 
                    </div>
                </div>
                </div>
                </div>
                </div>
                


            </div>


<!-- Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="imgdisplay"  class="img-fluid">
        <a href="" id="btndownload"> </a> <br>
        <strong id="msgdisplay"></strong>
        <div id="divpdfdisplay" class="embed-responsive embed-responsive-16by9">
        <iframe id="pdfdisplay" class="embed-responsive-item" src="" allowfullscreen></iframe>
        </div>
        <hr>
        <!-- 
        <div class="row">	        
        <div class="resizer-demo" id="resizer-demo" name="resizer-demo"></div>
         </div> -->
         <div id="vanilla-demo"></div>
         <button class="btn btn-primary btn-block upload-image" style="margin-top:2%">Update Image</button>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Delete Modal -->
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
                        
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
            <script src="<?php echo asset('/').'public'?>/admin/js/vendor/jquery-1.12.4.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
            <link rel="stylesheet" href="<?php echo asset('/').'public/';?>admin/css/croppie.css">
            
             <script src="<?php echo asset('/').'public/';?>admin/js/croppie.js"></script>
           
 
                        <!-- <script>
                            var el = document.getElementById('resizer-demo');
                                    var resize = new Croppie(el, {
                                        viewport: { width: 200, height: 200 },
                                        boundary: { width: 300, height: 300 },
                                        showZoomer: false,    
                                        enableResize: true,   
                                        mouseWheelZoom: 'ctrl',
                                        enableOrientation: true
                                    });                                    
                                    resize.bind({
                                        url: 'img url',
                                        
                                    });
                                    //on button click
                                    resize.result('blob').then(function(blob) {
                                        // do something with cropped blob
                                    //alert('ok');
                                    });
                        </script> -->
            <script>
                function formSubmit() {
                    $("#deleteForm").submit();
                }
                $( ".imgRemove" ).click(function() {
                    var id = (this).id;
                    var path = $(this).attr('pathval');                    
                    var urlstr = "{{url('textla/media/delete?id=')}}";
                    urlstr = urlstr + id + "&path=" + path;                    
                    $("#deleteForm").attr('action', urlstr);
                    $('#DeleteModal').modal('show');
                });  
                function viewMedia(filepath){
                    $('#pdfdisplay').attr("src","");
                        $('#imgdisplay').attr("src","");
                        $('#msgdisplay').text('');
                        $('#btndownload').text('');                        
                        $('.modal-content img').css('max-height',(($( window ).height()*0.8)-86));
                        $('#mediaModal').modal('show');
                        $('#imgdisplay').attr("src","https://cms.codequalitytechnologies.com/public/media/sample/Loading.gif");
                        $('#pdfdisplay').attr("src","https://cms.codequalitytechnologies.com/public/media/sample/Loading.gif");
                        $('#divpdfdisplay').hide();
                        //alert($(this).attr('filepath'));
                        fileName = filepath;
                        fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
                        switch (fileExtension) {
                            case 'png': case 'jpeg': case 'jpg':                                
                                $('#imgdisplay').attr("src","<?php echo asset('/').'public'?>/"+fileName);
                                 var el = document.getElementById('vanilla-demo'); 
                                    var vanilla = new Croppie(el, {                                        
                                        viewport: { width: 200, height: 200 },
                                        boundary: { width: 300, height: 300 },
                                        showZoomer: true,
                                        enableResize: true,
                                        enableOrientation: true,
                                        mouseWheelZoom: 'ctrl'
                                    });
                                    $('#mediaModal').on('shown.bs.modal', function(){    
                                    vanilla.bind({                                        
                                        url: "<?php echo asset('/').'public'?>/"+ fileName,                                        
                                    });
                                    //on button click
                                                            
                                        
                                    });

                                    $('.upload-image').on('click', function (ev) {                                                                                  
                                           vanilla.result('blob').then(function(blob) {
                                               // do something with cropped blob
                                               alert('Image Done');
                                              
                                               
                                           });
                                           
                                           });

                                break;
                            case 'pdf':  
                                $('#imgdisplay').attr("src","");
                                $('#divpdfdisplay').show();                             
                                $('#pdfdisplay').attr("src","<?php echo asset('/').'public'?>/"+fileName);
                                break;
                            default:
                            $('#imgdisplay').attr("src","");
                            $('#msgdisplay').text('File not Display Here Please Download it!!');
                            $('#btndownload').attr("href","<?php echo asset('/').'public'?>/"+fileName);
                            $('#btndownload').text('Download Now');                        
                               
                        }
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
                        $(".dropzone").toggle();
                    });
                    $(".file-preview").click(function(){                                           
                        fileName = $(this).attr('filepath');
                        viewMedia(fileName);
                        //(JSON.parse($(this).attr('data')));

                    })

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
                    url: "{{url('textla/media/upload')}}",
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
                            let js = JSON.stringify(item);
                            res += '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">';
                            res += '<a href="javascript:;" data=\''+js+'\' filepath="'+item.media_url+'" class="file-preview">';
                            if(item.file_type == 'png' || item.file_type == 'jpg' || item.file_type == 'jpeg'){
                                res += '<img src="<?php echo asset('/').'public'?>/'+item.media_url+'" class="category-image img-responsive img-fluid media-img" >';
                            }else{
                                res += '<img src="<?php echo asset('/').'public'?>/default/file.png" class="category-image img-responsive img-fluid media-img" >';
                            }
                            res += '</a>';
                            res += '<a href="javascript:;" id="'+item.id+'"  pathval="'+item.media_url+'" class="imgRemove btn btn-xs btn-danger form-control" style="margin-top:-15px;"><i class="fa fa-trash"></i></a>';
                            res += '</div>';
                        }
                        $("#fileslist").html(res);
                        $(".dropzone").toggle();
                        $(".file-preview").click(function(){                             
                            fileName = $(this).attr('filepath');
                            viewMedia(fileName);
                        })
                        function formSubmit() {
                            $("#deleteForm").submit();
                        }
                        $( ".imgRemove" ).click(function() {
                            var id = (this).id;
                            var path = $(this).attr('pathval');                    
                            var urlstr = "{{url('textla/media/delete?id=')}}";
                            urlstr = urlstr + id + "&path=" + path;                    
                            $("#deleteForm").attr('action', urlstr);
                            $('#DeleteModal').modal('show');
                        })
                    },
                    completemultiple: function (file, response) {
                        // console.log(response)
                    },
                    reset: function () {
                    }
                });
                window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                    $(this).remove();
                                });
                            }, 3000);
            </script>
        </div>
    </div>
@endsection