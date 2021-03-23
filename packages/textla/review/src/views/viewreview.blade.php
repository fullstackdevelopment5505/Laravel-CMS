<div class="modal fade" id="viewReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <div class="form-group col-md-6">
                        <label for="city">Rating</label>
                        <div class="at-rating">
                            @for ($i = 0; $i < 5; ++$i)
                                <i class="fa fa-star{{ $order->rating_star<=$i?'-o':'' }}" aria-hidden="true"></i>
                            @endfor
                        </div>
                    </div>                                      
                    <div class="form-group col-md-6">
                        <label for="address">Review</label>
                        <p>{{$order->review_comment}}</p>
                    </div>       
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>    
</div>