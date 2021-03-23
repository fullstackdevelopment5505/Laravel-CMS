
@extends('admin.layout.app')
@section('content')
    <div ng-app="myApp" ng-controller="productCtrl" ng-init="submitted =false">
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
                                                <h1>Create Product</h1>
                                            </div>
                                        </div>
                                        <div class="col-md-3 m-b-15 text-right">
                                           <a href="{{url('textla/product')}}" class="btn btn-primary  btn-sm">Back</a>
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
                                               <h4>Product updated successfully</h4>
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
                                                 <button type="button" class="btn btn-primary" ng-click="selectMedia()">Select</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>                            
                                    <form name="productForm" ng-submit="submitForm(productForm.$valid)" novalidate method="post" id="product_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="username">Product Name <i class="fa fa-asterisk error"></i></label>
                                                    <input type="text" placeholder="Product Name" msg="Please enter you product name" value="" name="product_name" id="product_name" class="form-control form-control-sm" required ng-model="product.product_name">
                                                    <p ng-class="((submitted || productForm.product_name.$dirty) && productForm.product_name.$error.required) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="username">SKU <i class="fa fa-asterisk error"></i></label>
                                                    <input type="text" placeholder="SKU Number" msg="Please enter you product sku" value="" name="product_sku" id="product_sku" class="form-control form-control-sm" required ng-model="product.product_sku">
                                                    <p ng-class="((submitted || productForm.product_sku.$dirty) && productForm.product_sku.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                               
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="username">Product Slug <i class="fa fa-asterisk error"></i></label>
                                                    <input type="text" placeholder="Product Slug" msg="Please enter you product slug" value="" name="product_slug" id="product_slug" class="form-control form-control-sm" required ng-model="product.product_slug">
                                                    <p ng-class="((submitted || productForm.product_slug.$dirty) && productForm.product_slug.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                               
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="username">Product Description <i class="fa fa-asterisk error"></i></label>
                                                    <textarea type="text" placeholder="Product Description" msg="Please enter you product Description" value="" ck-editor name="product_description" id="product_description" class="form-control form-control-sm" required ng-model="product.product_description"></textarea>
                                                    <p ng-class="((submitted || productForm.product_description.$dirty) && productForm.product_description.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a data-toggle="tab" href="#categories">Categories</a></li>
                                                    <li><a data-toggle="tab" href="#data">Data</a></li>
                                                    <li><a data-toggle="tab" href="#images">Images</a></li>
                                                    <li><a data-toggle="tab" href="#relatedproducts">Related Products</a></li>
                                                    <li><a data-toggle="tab" href="#option">Option</a></li>
                                                    <li><a data-toggle="tab" href="#price">Price</a></li>
                                                    <li><a data-toggle="tab" href="#seo">SEO</a></li>
                                                    <li><a data-toggle="tab" href="#shipping">Shipping</a></li>
                                                </ul>

                                                <div class="tab-content product-content">
                                                    <div id="categories" class="tab-pane fade in active">
                                                        <select bootstrap2="false" ng-model="product.product_categories" name="product_categories" required ng-options="av as av.category_name for av in allCategories track by av.id" multiple bs-duallistbox></select>
                                                        <p ng-class="((submitted || productForm.product_categories.$dirty) && productForm.product_categories.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                    </div>
                                                    <div id="data" class="tab-pane fade">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                       <label class="control-label" for="username">UPC</label>
                                                                        <input type="text" placeholder="UPC" msg="Please enter you upc" value="" name="product_upc" id="product_upc" class="form-control form-control-sm" ng-model="product.product_upc">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                        <label class="control-label" for="username">Quantity</label>
                                                                        <input type="text" placeholder="Quantity" msg="Please enter you quantity" value="" name="product_quantity" id="product_quantity" class="form-control form-control-sm" required ng-model="product.product_quantity">
                                                                        <p ng-class="((submitted || productForm.product_quantity.$dirty) && productForm.product_quantity.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Out of Stock Status</label>
                                                                    <select msg="Please enter you Out of Stock Status" value="INSTOCK" name="product_out_of_stock_status" id="product_out_of_stock_status" class="form-control form-control-sm" required ng-model="product.product_out_of_stock_status">
                                                                        <option value="INSTOCK">InStock</option>
                                                                        <option value="OUTOFSTOCK">OutOfStock</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Date Available</label>
                                                                    <input type="text" placeholder="mm/dd/yyyy" msg="Please enter you upc" value="" name="date_of_available" id="date_of_available" class="form-control form-control-sm date_picker" ng-model="product.date_of_available">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Status</label>
                                                                    <select msg="Status" value="Enabled" name="product_status" id="product_status" class="form-control form-control-sm" required ng-model="product.product_status">
                                                                        <option selected value="Enabled">Enabled</option>
                                                                        <option value="Disabled">Disabled</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="images" class="tab-pane fade">
                                                        <div class="row">
                                                            <div class="col-md-2" ng-repeat="item in product.product_images">
                                                                <div class="product-img selected-images">
                                                                    <input type="radio" value="##item.id##" name="primary_image" required ng-model="product.primary_image">
                                                                    <i class="fa fa-trash text-danger" ng-click="removeSelectedImage($index, item)"></i>
                                                                    <img src="<?php echo asset('/').'public'?>/##item.media_url##" height="60" width="60" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="product-img add-product" ng-click="openMedia()">
                                                                    <img src="https://admin.spurtcart.com/assets/img/add-photo-big.png" >
                                                                    <p>Add Images</p>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div id="relatedproducts" class="tab-pane fade">
                                                         <select bootstrap2="false" ng-model="product.related_products" name="related_products" ng-options="av as av.product_name for av in allProducts track by av.id" multiple bs-duallistbox></select>
                                                    </div>
                                                    <div id="option" class="tab-pane fade">
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <button class="btn btn-primary btn-xs" type="button" ng-click="addoption()">Add Option</button>
                                                            </div>
                                                        </div>
                                                         <div class="row product-option-data" ng-repeat="item in product.product_options" ng-init="outerIndex=$index">
                                                            <ng-form name="optionForm">
                                                                <div class="col-md-11">
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="username">Option Title</label>
                                                                        <input type="text" placeholder="Option Title" msg="Please enter your option title" value="" name="option_name" id="##createId('option_name', $index)##" class="form-control form-control-sm option_name" required ng-model="item.option_name">
                                                                        <p ng-class="((submitted || optionForm.option_name.$dirty) && optionForm.option_name.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                    </div>
                                                                
                                                                </div>
                                                                <div class="col-md-1 p-t-25"><button class="btn btn-primary btn-xs" ng-show="product.product_options.length > 1" type="button" ng-click="removeoption($index)">Delete</button></div>
                                                                <div class="col-md-12">
                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <th>Option Title</th>
                                                                            <th>Option Quantity</th>
                                                                            <th>Price Delemetor</th>
                                                                            <th>Price</th>
                                                                            <th><button type="button" class="btn btn-primary btn-xs" ng-click="addoptionvalue(outerIndex)"><i class="fa fa-plus"></i></button></th>
                                                                        </tr>
                                                                        <tr ng-repeat="jitem in item.options_values" ng-init="innerIndex=$index">
                                                                            <td>
                                                                                <input type="text" placeholder="Option Title" msg="Please enter your option title" value="" name="option_value" id="##createId('option_value', $index)##" class="form-control form-control-sm option_value" required ng-model="jitem.option_value">
                                                                                <p ng-class="((submitted || optionForm.option_value.$dirty) && optionForm.option_value.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="Option Quantity" msg="Please enter your option title" value="" name="option_quantity" id="##createId('option_quantity', $index)##" class="form-control form-control-sm option_quantity" required ng-model="jitem.option_quantity">
                                                                                <p ng-class="((submitted || optionForm.option_quantity.$dirty) && optionForm.option_quantity.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                            </td>
                                                                            <td>
                                                                                <select  class="form-control form-control-sm price_inc_dec_delemeter" required name="price_inc_dec_delemeter" ng-model="jitem.price_inc_dec_delemeter">
                                                                                    <option value="+">+</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                                <p ng-class="((submitted || optionForm.price_inc_dec_delemeter.$dirty) && optionForm.price_inc_dec_delemeter.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="Price" msg="Please enter your option title" value="" name="price" id="##createId('price', $index)##" class="form-control form-control-sm price" required ng-model="jitem.price">
                                                                                <p ng-class="((submitted || optionForm.price.$dirty) && optionForm.price.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                            </td>
                                                                            <th><button type="button" ng-click="removeoptionvalue(outerIndex, innerIndex)"  ng-show="item.options_values.length > 1" class="btn btn-primary btn-xs"><i class="fa fa-minus"></i></button></th>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                             </ng-form>
                                                        </div>   
                                                    </div>
                                                    <div id="price" class="tab-pane fade">
                                                        <div class="panel-group" id="accordion">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                                    Default Price</a>
                                                                </h4>
                                                                </div>
                                                                <div id="collapse1" class="panel-collapse collapse in">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Product Cost</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon">1</span>
                                                                                    <input type="text" placeholder="Product Cost" msg="Please enter you Width" value="" name="product_cost" id="product_cost" class="form-control form-control-sm price-table" ng-keyup="calculatePrice()" required ng-model="product.product_cost">
                                                                                    <p ng-class="((submitted || productForm.product_cost.$dirty) && productForm.product_cost.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Packing Cost</label>
                                                                               <div class="input-group">
                                                                                    <span class="input-group-addon">1</span>
                                                                                    <input type="text" placeholder="Packing Cost" msg="Please enter you Width" value="" name="packing_cost" id="packing_cost" class="form-control form-control-sm price-table" ng-keyup="calculatePrice()" required ng-model="product.packing_cost">
                                                                                    <p ng-class="((submitted || productForm.packing_cost.$dirty) && productForm.packing_cost.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Shipping Cost</label>
                                                                               <div class="input-group">
                                                                                    <span class="input-group-addon">1</span>
                                                                                    <input type="text" placeholder="Shipping Cost" msg="Please enter you Width" value="" name="shipping_cost" id="shipping_cost" class="form-control form-control-sm price-table" ng-keyup="calculatePrice()" required ng-model="product.shipping_cost">
                                                                                    <p ng-class="((submitted || productForm.shipping_cost.$dirty) && productForm.shipping_cost.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Others</label>
                                                                               <div class="input-group">
                                                                                    <span class="input-group-addon">1</span>
                                                                                    <input type="text" placeholder="Other Cost" msg="Please enter you Width" value="" name="other_cost" id="other_cost" class="form-control form-control-sm price-table" ng-keyup="calculatePrice()" required ng-model="product.other_cost">
                                                                                    <p ng-class="((submitted || productForm.other_cost.$dirty) && productForm.other_cost.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Gross Total</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon">1</span>
                                                                                    <input type="text" placeholder="Gross Total" msg="Please enter you Width" value="" name="gross_total" id="gross_total" class="form-control form-control-sm price-table" ng-keyup="calculatePrice()" required ng-model="product.gross_total">
                                                                                    <p ng-class="((submitted || productForm.gross_total.$dirty) && productForm.gross_total.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Tax Percent</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon">1</span>
                                                                                    <input type="text" placeholder="Tax Percent" msg="Please enter you Width" value="" name="tax_percent" id="tax_percent" class="form-control form-control-sm price-table" ng-keyup="calculatePrice()" required ng-model="product.tax_percent">
                                                                                    <p ng-class="((submitted || productForm.tax_percent.$dirty) && productForm.tax_percent.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Total Cost (MRP)</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon">1</span>
                                                                                    <input type="text" placeholder="Total Cost (MRP)" msg="Please enter you Width" value="" name="total_cost" id="total_cost" class="form-control form-control-sm price-table" ng-keyup="calculatePrice()" required ng-model="product.total_cost">
                                                                                    <p ng-class="((submitted || productForm.total_cost.$dirty) && productForm.total_cost.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                                    Discount</a>
                                                                </h4>
                                                                </div>
                                                                <div id="collapse2" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                     <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Price</label>
                                                                                <input type="text" placeholder="Price" msg="Please enter you Width" value="" name="discount_price" id="discount_price" class="form-control form-control-sm"  ng-model="product.discount_price">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Date Start</label>
                                                                                <input type="text" placeholder="mm/dd/yyyy" msg="Please enter you Width" value="" name="discount_date_start" id="discount_date_start" class="form-control form-control-sm date_picker" ng-model="product.discount_date_start">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="username">Date End</label>
                                                                                <input type="text" placeholder="mm/dd/yyyy" msg="Please enter you Width" value="" name="discount_date_end" id="discount_date_end" class="form-control form-control-sm date_picker"  ng-model="product.discount_date_end">
                                                                               
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                    </div>
                                                    <div id="seo" class="tab-pane fade">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Meta Tag Title</label>
                                                                    <input type="text" placeholder="Meta Tag Title" msg="Please enter you Width" value="" name="meta_tag_title" id="meta_tag_title" class="form-control form-control-sm"  ng-model="product.meta_tag_title">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Meta Tag Keyword</label>
                                                                    <input type="text" placeholder="Meta Tag Keyword" msg="Please enter you Width" value="" name="meta_tag_keyword" id="meta_tag_keyword" class="form-control form-control-sm"  ng-model="product.meta_tag_keyword">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Meta Tag Description</label>
                                                                    <textarea type="text" placeholder="Meta Tag Description" msg="Please enter you Width" value="" name="meta_tag_description" id="meta_tag_description" class="form-control form-control-sm"  ng-model="product.meta_tag_description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="shipping" class="tab-pane fade">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Required Shipping</label>
                                                                    <div>
                                                                        <label class="radio-inline"><input type="radio" value="FREE" name="require_shipping" ng-model="product.require_shipping" checked>FREE</label>
                                                                        <label class="radio-inline"><input type="radio" value="PAID" name="require_shipping" ng-model="product.require_shipping" >PAID</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Width</label>
                                                                    <input type="text" placeholder="Width" msg="Please enter you Width" value="" name="shipping_width" id="shipping_width" class="form-control form-control-sm" required ng-model="product.shipping_width">
                                                                    <p ng-class="((submitted || productForm.shipping_width.$dirty) && productForm.shipping_width.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Height</label>
                                                                    <input type="text" placeholder="Height" msg="Please enter you Width" value="" name="shipping_height" id="shipping_height" class="form-control form-control-sm" required ng-model="product.shipping_height">
                                                                    <p ng-class="((submitted || productForm.shipping_height.$dirty) && productForm.shipping_height.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Length</label>
                                                                    <input type="text" placeholder="Length" msg="Please enter you Width" value="" name="shipping_length" id="shipping_length" class="form-control form-control-sm" required ng-model="product.shipping_length">
                                                                    <p ng-class="((submitted || productForm.shipping_length.$dirty) && productForm.shipping_length.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Weight</label>
                                                                    <input type="text" placeholder="Weight" msg="Please enter you Width" value="" name="shipping_weight" id="shipping_weight" class="form-control form-control-sm" required ng-model="product.shipping_weight">
                                                                    <p ng-class="((submitted || productForm.shipping_weight.$dirty) && productForm.shipping_weight.$error.required ) ? 'show-error': 'hide-error'" class="text-danger hide-error">This field is required.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <link href="https://raw.githubusercontent.com/istvan-ujjmeszaros/bootstrap-duallistbox/master/src/bootstrap-duallistbox.css" rel="stylesheet" type="text/css" media="all" /> 
                                            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                                            <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
                                            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                                            <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                                            <script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.8/jquery.bootstrap-duallistbox.js"></script>
                                            <script data-require="angular.js@1.4.x" src="https://code.angularjs.org/1.4.9/angular.js" data-semver="1.4.9"></script>
                                            <script src="<?php echo asset('/').'public/';?>ctrl/jquery.bootstrap-duallistbox.min.js"></script>
                                            <script src="https://rawgit.com/frapontillo/angular-bootstrap-duallistbox/master/dist/angular-bootstrap-duallistbox.js"></script>
                                            <script src="<?php echo asset('/').'public/';?>ctrl/productedit.js"></script>
                                            <script>
                                                window.setTimeout(function() {
                                                     $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                                        $(this).remove();
                                                    });
                                                }, 3000);
                                                var loadFile = function(event) {
                                                    var reader = new FileReader();
                                                    reader.onload = function(){
                                                    var output = document.getElementById('output');
                                                    output.src = reader.result;
                                                    };
                                                    reader.readAsDataURL(event.target.files[0]);
                                                };
                                                // CKEDITOR.replace('product_description');
                                                // var product_categories = $('select[name="product_categories"]').bootstrapDualListbox();
                                                var related_products = $('select[name="related_products"]').bootstrapDualListbox();
                                                $(".date_picker").datepicker({
                                                    changeMonth: true,
                                                    changeYear: true
                                                });
                                                $(".file-preview").click(function () {
                                                    $(this).toggleClass("selected");
                                                })
                                                // $("#product_form").validate({
                                                //     submitHandler: function(form) {
                                                //         form.submit();
                                                //     },
                                                //     rules: {
                                                //         product_name: {
                                                //             required: true,
                                                //             maxlength: 50
                                                //         },
                                                //         product_sku: {
                                                //             required: true,
                                                //             maxlength: 50
                                                //         },
                                                //         product_slug: {
                                                //             required: true,
                                                //             maxlength: 50
                                                //         },
                                                //         product_description: {
                                                //             required: true,
                                                //             maxlength: 2000
                                                //         },
                                                //         'product_categories[]':{
                                                //             required: true,
                                                //         } 
                                                //     },
                                                //     messages: {
                                                                                           
                                                //     },
                                                // })
                                            </script>
                                        </div>
                                        <br>
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
