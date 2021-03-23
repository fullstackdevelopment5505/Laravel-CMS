@extends('layouts.master')
@section('content')
    <section class="banner" style="padding:5%;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text">
                    <h1 class="fadeInLeft animated">
                        <h2>{{$title}}</h2>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        <ul class="filter-catagories" id="treeList">
                            @foreach($categories as $category)
                                <li><input type="checkbox" class="category_filter" name="selectedRole" category="{{ $category->id }}">{{ $category->category_name }}
                                @if(count($category->children))
                                    <ul>
                                    @include('part.manage_child',['childs' => $category->children])
                                    </ul>
                                @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Price ({{$currency}})</h4>
                        <div class="filter-range-wrap">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount" value="{{$minPrice}}">
                                    <input type="text" id="maxamount" value="{{$maxPrice}}">
                                </div>
                            </div>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="{{$minPrice}}" data-max="{{$maxPrice}}">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                        </div>
                        <a href="#" class="filter-btn filter_apply">Price Filter</a>
                        <a href="#" class="filter-btn clear_all">Clear All</a>
                    </div>
                </div>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_category" id="hidden_category" value="" />
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <div class="select-option">
                                    <select class="sorting sorting_filter form-control" id='sorting' value="asc">
                                        <option value="asc">Price High To Low</option>
                                        <option value="desc">Price Low To High</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-4"></div>
                            <div class="col-lg-4 col-md-4">
                                <div class="select-option">
                                    <input class="serach form-control" id='serach' type="text" onKeyUp="searchParam(event)" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  id="tbody">
                    @include('part.product')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
    
    
@endsection