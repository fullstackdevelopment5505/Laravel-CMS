
@extends('admin.layout.app')
@section('content')
    <div ng-app="myApp" ng-controller="myCtrl" ng-init="submitted =false">
        @include('admin.layout.sidebar')
        <div  class="all-content-wrapper">
            @include('admin.layout.header')
            <div class="data-table-area mg-b-15" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline13-list">
                                <div class="sparkline13-hd">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="main-sparkline13-hd">
                                                <h1>Update Page</h1>
                                            </div>
                                        </div>
                                        <div class="col-md-3 m-b-15 text-right">
                                           <a href="{{url('textla/page')}}" class="btn btn-primary  btn-sm">Back</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="sparkline13-graph"> 
                                    <div class="modal fade" data-backdrop="static" data-keyboard="false"  id="successModal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalTitle">Success</h5>
                                            </div>
                                            <div class="modal-body text-center">
                                               <h4>Page updated successfully</h4>
                                            </div>
                                            <div class="modal-footer text-center">
                                                 <button type="button" class="btn btn-primary" ng-click="closeModel()">Ok</button>
                                            </div>
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
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 form-group " >
                                                    <a href="javascript:;" filepath='{{$media->media_url}}' data='{{$media}}' class="file-preview" >
                                                            <img src="<?php echo asset('/').'public'?>/{{$media->media_url}}" class="category-image img-responsive img-fluid media-img" >
                                                        </a>
                                                    </div>            
                                                    @endif
                                            @endforeach 
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" ng-click="selectMedia()">Select</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>                            
                                    <form name="pageForm" ng-submit="submitForm(pageForm.$valid)" novalidate method="post" id="page_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="username">Page Title <i class="fa fa-asterisk error"></i></label>
                                                    <input type="text" placeholder="Page Title" msg="Please enter you Page Title" value="" name="page_title" id="page_title" class="form-control form-control-sm" required ng-model="page.page_title">
                                                    <p ng-class="((submitted || pageForm.page_title.$dirty) && pageForm.page_title.$error.required) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                            
                                            <a ng-click="openModel()" style="cursor: pointer">
                                                    <img id="output" src="https://placehold.it/80x80" class="img-preview img-thumbnail img-fluid"/>
                                                    <input type="text" style="opacity: 0;position: absolute;bottom: 25px;" placeholder="Category Name" value="" name="page_thumbnail" id="page_thumbnail" class="form-control form-control-sm">
                                                </a><p>Add Thumbnail</p>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="page_description">Page Description <i class="fa fa-asterisk error"></i></label>
                                                    <textarea type="text" placeholder="Page Description" msg="Please enter you page Description" value="" ck-editor name="page_description" id="page_description" class="form-control form-control-sm" required ng-model="page.page_description"></textarea>
                                                    <p ng-class="((submitted || pageForm.page_description.$dirty) && pageForm.page_description.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">   
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Meta Tag Title</label>
                                                                    <input type="text" placeholder="Meta Tag Title" msg="Please enter you Width" value="" name="meta_tag_title" id="meta_tag_title" class="form-control form-control-sm"  ng-model="page.meta_tag_title">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Meta Tag Keyword</label>
                                                                    <input type="text" placeholder="Meta Tag Keyword" msg="Please enter you Width" value="" name="meta_tag_keyword" id="meta_tag_keyword" class="form-control form-control-sm"  ng-model="page.meta_tag_keyword">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Meta Tag Description</label>
                                                                    <textarea type="text" placeholder="Meta Tag Description" msg="Please enter you Width" value="" name="meta_tag_description" id="meta_tag_description" class="form-control form-control-sm"  ng-model="page.meta_tag_description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                                                                     
                                               
                                            </div>
                                            <link href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.8/bootstrap-duallistbox.css" rel="stylesheet" type="text/css" media="all" /> 
                                            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                                            <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
                                            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                                            <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                                            <script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.8/jquery.bootstrap-duallistbox.js"></script>
                                            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
                                            <script src="<?php echo asset('/').'public/';?>ctrl/pagesedit.js"></script>
                                            <script>
                                                window.setTimeout(function() {
                                                     $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                                        $(this).remove();
                                                    });
                                                }, 3000);
                                            </script>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-success btn-sm" type="submit">Save Changes</button>
                                                <a href="{{url('textla/page')}}" class="btn btn-primary btn-sm"> Cancel</a>
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
