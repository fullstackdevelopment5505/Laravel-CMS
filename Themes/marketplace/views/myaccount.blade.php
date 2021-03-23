@extends('layouts.master')
@section('content')
<section class="banner" style="padding:5%;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text">
                    <h1 class="fadeInLeft animated">
                        <h2>My Account</h2>
                    </h1>
                </div>
            </div>
        </div>
    </section>
   

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">

            <div class="row">
                @include('layouts.sidebar')
                <div class="col-lg-9 order-1 order-lg-2">
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
                                <p id="smsprint"></p>
                                {{ session('error') }}
                            </div>
                            @endif
                    </div>
                    <div class="col-lg-6 offset-lg-3">
                        <div class="register-form">
                            <h2>Update Profile</h2>
                            <form action="/updatemyaccount" method="post" class="needs-validation" novalidate>
                                {{ csrf_field() }}
                                <div class="group-input">
                                    <label for="fullname">Full name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{Auth::user()->fullname}}" id="fullname" name="fullname" required>
                                    <div class="invalid-feedback">
                                    Please Enter Full Name
                                    </div>
                                </div>
                                <div class="group-input">
                                    <label for="email">Email</label>
                                    <input disabled="disabled" value="{{Auth::user()->email}}" type="text" id="email" name="email" required>
                                </div>
                                <div class="group-input">
                                    <label for="mobile">Mobile <span class="text-danger">*</span></label>
                                    <input type="text" value="{{Auth::user()->mobile}}" id="mobile" name="mobile" required>
                                    <div class="invalid-feedback">
                                    Please Enter Mobile Number
                                    </div>
                                </div>
                                <button type="submit" class="site-btn register-btn">Update Profile</button>
                            </form>                        
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="row address">
                        
                        @foreach($data as $row)
                            
                                <div class="card my-2 mx-1" style="max-width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$row->address_type}}</h5>
                                        <hr>
                                        <p class="card-text">
                                        {{$row->address}},<br>
                                        {{$row->city}},{{$row->state}},{{$row->zipcode}}<br>
                                        {{$row->country}}
                                        </p>
                                        <p class="card-text">
                                        {{$row->contact_no}}
                                        </p>
                                        
                                    </div>
                                    <div class="card-footer">
                                    <a href="javascript:" class="btn btn-primary btn-sm" onClick="update_Address({{$row->id}})">Edit</a>
                                    <a href="javascript:" class="btn btn-danger btn-sm" onClick="deleteCartItem({{$row->id}})">Delete</a>
                                        @if($row->default ==0)
                                        <a href="javascript:" class="btn btn-warning btn-sm" onClick="set_Address({{$row->id}})"></i>Default</a>
                                        @endif  
                                    </div>
                                </div>                            
                        @endforeach    
                        
                            <div class="col-lg-4" style="margin-top: 8px;">
                                <div class="card add-new">
                                    <div class="card-body text-center">
                                        <h5 data-toggle="modal" data-target="#addNewAddress" class="card-title">
                                            <i class="fa fa-plus plus-add"></i>    
                                            Add New</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="modal fade" id="addNewAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/useraddress" method="post" class="needs-validation-address" novalidate>                           
      {{ csrf_field() }}
      <div class="modal-body">
      <div class="card">
        <div class="card-body">
            <div class="row">  
                <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" cols="20" class="form-control"  required></textarea>                   
                </div>                
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" class="form-control" required>
                   
                </div>
                <div class="form-group col-md-6">
                    <label for="state">state</label>
                    <input type="text" id="state" name="state" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="country">country</label>
                    <input type="text" id="country" name="country" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="contact_no">Contact No</label>
                    <input type="text" id="contact_no" name="contact_no" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                <label for="addType">Address Type</label>
                    <select name="addType"  id="addType" class="form-control">
                    <option value="Home">Home</option>
                    <option value="Work">Work</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                     <label for="set_default">
                        Default Address
                         <input type="checkbox" id="set_default"  name="set_default">
                        <span class="checkmark"></span>
                     </label>
                  </div> 
                </div>        
            </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="site-btn register-btn">Save</button>
      </div>
      </form>
    </div>
  </div>    
</div>
<div class="modal fade" id="UpdateAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle1">Update Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/updateuseraddress" method="post" class="needs-validation-address" novalidate>                           
      {{ csrf_field() }}
      <div class="modal-body">
      <div class="card">
        <div class="card-body">
            <div class="row">  
                <div class="form-group col-md-6">
                    <label for="addressUpdate">Address</label>
                    <textarea name="addressUpdate" id="addressUpdate" cols="20" class="form-control"  required></textarea>                   
                </div>                
                <div class="form-group col-md-6">
                    <label for="cityUpdate">City</label>
                    <input type="text" id="cityUpdate" name="cityUpdate" class="form-control" required>
                   
                </div>
                <div class="form-group col-md-6">
                    <label for="stateUpdate">state</label>
                    <input type="text" id="stateUpdate" name="stateUpdate" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="countryUpdate">country</label>
                    <input type="text" id="countryUpdate" name="countryUpdate" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="contact_noUpdate">Contact No</label>
                    <input type="text" id="contact_noUpdate" name="contact_noUpdate" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcodeUpdate">Zipcode</label>
                    <input type="text" id="zipcodeUpdate" name="zipcodeUpdate" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                <label for="addTypeUpdate">Address Type</label>
                    <select name="addTypeUpdate"  id="addTypeUpdate" class="form-control">
                    <option value="Home">Home</option>
                    <option value="Work">Work</option>
                    </select>
                </div>
                <input type="hidden" name="add_id" id="add_id">              
                </div>        
            </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="site-btn register-btn">Save</button>
      </div>
      </form>
    </div>
  </div>    
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
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
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation-address');
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
<script>
        function deleteCartItem(row){     
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure you want to delete Address!',
                buttons: {
                    confirm: function () {
                        window.location.href="/deleteuserAddress?id="+row;
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
        }
        function set_Address(row){     
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure you want to set Default Address!',
                buttons: {
                    confirm: function () {
                        window.location.href="/set_userAddress?id="+row;
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
        }


        function update_Address(id){  
            $.ajax({
                url: "<?php echo asset('/').'editeuserAddress?id='?>" + id,
                data: "{}",
                success: function(data) {  
                   var obj = JSON.parse(data); 
                   $('#add_id').attr('value',obj.id);
                    $('#cityUpdate').attr('value',obj.city);
                    $('#stateUpdate').attr('value',obj.state);
                    $('#countryUpdate').attr('value',obj.country);
                    $('#zipcodeUpdate').attr('value',obj.zipcode);
                    $('#contact_noUpdate').attr('value',obj.contact_no);
                    $('#addressUpdate').attr('value',obj.contact_no);
                    $("textarea#addressUpdate").val(obj.address);                    
                    $('#addTypeUpdate').val(obj.address_type);                    
                    $('#UpdateAddress').modal('show');
                }
            })
        }
</script>

@endsection