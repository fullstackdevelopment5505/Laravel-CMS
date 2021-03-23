@extends('layouts.master')
@section('content')
 <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-inner">
                        <div class="blog-detail-title">
                            <h2>{{$page['page_title']}}</h2>
                        </div>
                        <div>
                             <?php echo($page['page_description']);?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection