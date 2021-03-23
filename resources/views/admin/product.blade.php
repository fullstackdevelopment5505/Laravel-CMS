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
                                <div class="col-md-5">
                                    <div class="main-sparkline13-hd">
                                        <h1><i class="fa fa-list" aria-hidden="true"></i> Product</h1>
                                    </div>
                                </div>
                                <div class="col-md-3 m-b-15 search">
                                <input type="text" name="serach" id="serach" placeholder="Search"
                                    class="form-control form-control-sm" />
                            </div>
                                <div class="col-md-4 m-b-15 text-right" style="padding-left: 0;">
                                    
                                    <a href="<?php echo asset('/').'textla/product/create'?>"
                                        class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Product</a>
                                        <a href="<?php echo asset('/').'textla/product/export'?>"
                                        class="btn btn-warning btn-sm"> <i class="fa fa-cloud-download" aria-hidden="true"></i> Export Product</a>
                                        <a href="javascript:;"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#ImportModal"> <i class="fa fa-cloud-upload" aria-hidden="true"></i> Import Product</a>
                                        
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
                                    <th width="35%" class="sorting" data-sorting_type="asc" data-column_name="product_name"
                                        style="cursor: pointer">Product Name<span id="product_name_icon"></span></th>
                                    <th width="15%" class="sorting" data-sorting_type="asc" data-column_name="product_sku"
                                        style="cursor: pointer">SKU<span id="product_sku_icon"></span></th>
                                    <th width="10%">Image</th>
                                    <th width="10%" class="sorting" data-sorting_type="asc" data-column_name="total_cost"
                                        style="cursor: pointer">Total cost<span id="total_cost_icon"></th>
                                    <th width="5%" class="sorting" data-sorting_type="asc"
                                        data-column_name="product_quantity" style="cursor: pointer">Qty<span
                                            id="product_quantity_icon"></th>
                                    <th width="5%">Deal</th>
                                    <th width="6%">Home</th>
                                    <th width="6%">Sale</th>
                                    <th width="8%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('admin.part.product_pagination')
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
                        <div id="RemoveOn_dealModal" class="modal fade text-danger" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <!-- Modal content-->
                                <form action="" id="RemoveOn_dealForm" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title text-center">REMOVE CONFIRMATION</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <p class="text-center">Are You Sure Want To Remove this product to Deal Of The Week ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <center>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                                                    onclick="formSubmiton_dealremove()">Yes, Remove</button>
                                            </center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="ImportModal" class="modal fade text-danger" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <!-- Modal content-->
                                <form name="Form" action="{{url('textla/product/import')}}" method="post" id="form" enctype="multipart/form-data">                                  
                                
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title text-center">SELECT FILE</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <p class="text-center">
                                            <a href="https://cms.codequalitytechnologies.com/public/media/sample/ProductAddSample.xlsx">Download Sample File </a>
                                            </p>
                                            <div class="btn btn">
                                            <input type="file" name="file" id="file" accept=".xlsx" onchange="checkfile(this);"/>
                                            </div>                                       
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <center>
                                                <button type="button" class="btn btn-success"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="" class="btn btn-primary"  >Import, Product</button>
                                            </center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="DealValueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Product Deal Of The Week </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('textla/product/on_dealproductAdd')}}" method="post" class="needs-validation" novalidate>                           
                                {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="card">
                                        <div class="card-body">
                                            <div class="row">                                                                  
                                                <div class="form-group col-md-3">
                                                    <label for="city">Deal Price<span class="text-danger">*</span></label>
                                                    <input type="text"  id="deal_price" placeholder="{{$currency}}" name="deal_price" class="form-control" required>                                                
                                                </div>
                                                <div class="form-group col-md-9">
                                                <div class="row">
                                                <div class="form-group col-md-4">
                                                <label for="state">Deal End Date<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="yy-mm-dd"  id="deal_end_date" name="deal_end_date"  class="form-control date_picker" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                <label for="deal_hour">Hour</label><br>
                                               
                                                <select name="deal_hour" id="deal_hour" class="form-control form-control-sm">
                                                    <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                <label for="deal_minute">Minutes</label>
                                                <select name="deal_minute" id="deal_minute" class="form-control form-control-sm">
                                                    <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                    <option value="32">32</option>
                                                    <option value="33">33</option>
                                                    <option value="34">34</option>
                                                    <option value="35">35</option>
                                                    <option value="36">36</option>
                                                    <option value="37">37</option>
                                                    <option value="38">38</option>
                                                    <option value="39">39</option>
                                                    <option value="40">40</option>
                                                    <option value="41">41</option>
                                                    <option value="42">42</option>
                                                    <option value="43">43</option>
                                                    <option value="44">44</option>
                                                    <option value="45">45</option>
                                                    <option value="46">46</option>
                                                    <option value="47">47</option>
                                                    <option value="49">49</option>
                                                    <option value="50">50</option>
                                                    <option value="51">51</option>
                                                    <option value="52">52</option>
                                                    <option value="53">53</option>
                                                    <option value="54">54</option>
                                                    <option value="55">55</option>
                                                    <option value="56">56</option>
                                                    <option value="57">57</option>
                                                    <option value="58">58</option>
                                                    <option value="59">59</option>
                                                    <option value="60">60</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                <label for="deal_second">Second</label>
                                                <select name="deal_second" id="deal_second" class="form-control form-control-sm">
                                                <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                    <option value="32">32</option>
                                                    <option value="33">33</option>
                                                    <option value="34">34</option>
                                                    <option value="35">35</option>
                                                    <option value="36">36</option>
                                                    <option value="37">37</option>
                                                    <option value="38">38</option>
                                                    <option value="39">39</option>
                                                    <option value="40">40</option>
                                                    <option value="41">41</option>
                                                    <option value="42">42</option>
                                                    <option value="43">43</option>
                                                    <option value="44">44</option>
                                                    <option value="45">45</option>
                                                    <option value="46">46</option>
                                                    <option value="47">47</option>
                                                    <option value="49">49</option>
                                                    <option value="50">50</option>
                                                    <option value="51">51</option>
                                                    <option value="52">52</option>
                                                    <option value="53">53</option>
                                                    <option value="54">54</option>
                                                    <option value="55">55</option>
                                                    <option value="56">56</option>
                                                    <option value="57">57</option>
                                                    <option value="58">58</option>
                                                    <option value="59">59</option>
                                                    <option value="60">60</option>
                                                    </select>
                                                </div>
                                                </div>
                                                    
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="address">Description<span class="text-danger">*</span></label>
                                                    <textarea name="deal_description" id="deal_description" cols="20" class="form-control"  required></textarea>                   
                                                </div>
                                            </div>        
                                            </div>
                                        </div> 
                                    </div>
                                <div class="modal-footer">
                                <input type="hidden" name="add_id" id="add_id">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                                </div>
                            </div>    
                     </div>
                                            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                                            <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>                                            
                                            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                                          
                                           <script type="text/javascript" language="javascript">
                            function checkfile(sender) {
                                var validExts = new Array(".xlsx");
                                var fileExt = sender.value;
                                fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
                                if (validExts.indexOf(fileExt) < 0) {
                                alert("Invalid file selected, valid file is " +
                                        validExts.toString() + " types." + "Please download sample file");  
                                        $(sender).val("");                            
                                return false;
                                }
                                else return true;
                            }
                        </script>
                        <script>
                            $(document).ready(function() {
                                function clear_icon() {
                                    $('#product_name_icon').html('');
                                    $('#product_sku_icon').html('');
                                    $('#total_cost_icon').html('');
                                    $('#product_quantity_icon').html('');
                                }
                                function fetch_data(page, sort_type, sort_by, query) {
                                    $.ajax({
                                        url: "<?php echo asset('/').'textla/product?page='?>" + page + "&sortby=" + sort_by + "&sorttype=" + sort_type + "&query=" + query,
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
                            

                            $( ".Value_Set" ).click(function() {
                                var Product_id = (this).id;
                                var Product_value = $(this).text();
                                var col_name =$(this).attr('col');
                                $(this).text('wait..')
                                set_value(Product_id,Product_value,col_name);
                            });                              

                            function set_value(id,value,colNM) {  
                                $.ajax({
                                    url: "<?php echo asset('/').'textla/product/sale?product_id='?>" + id + "&col_value=" + value +"&col_name=" + colNM,
                                    success: function(data) {                                     
                                        location.reload(true);
                                    }
                                })
                            }

                            $( ".on_deal" ).click(function() {
                                var Product_id = (this).id;
                                var deal_value = $(this).text();
                                var value1 = $(this).attr('value1');
                                //alert(value1);
                                $('#add_id').val(Product_id);
                                if(deal_value == 'NO')
                                {                                
                                    $('#DealValueModal').modal('show');

                                }else
                                {   
                                var urlstr = "{{url('textla/product/on_dealproductRemove?id=')}}";
                                urlstr = urlstr + Product_id;
                                $("#RemoveOn_dealForm").attr('action', urlstr);
                                $('#RemoveOn_dealModal').modal('show');
                                }
                            });                              

                            });
                            $(".date_picker").datepicker({  
                               dateFormat: 'yy-mm-dd',                                                                                           
                                changeMonth: true,
                                changeYear: true,                               
                                
                            });
                        </script>
                        <script>
                            function formSubmit() {
                                $("#deleteForm").submit();
                            }
                            function formSubmiton_dealremove() {
                                $("#RemoveOn_dealForm").submit();
                            }

                            function deleteData(id) {
                                var id = id;
                                var urlstr = "{{url('textla/product/delete?id=')}}";
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
<script>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {           
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }            
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection