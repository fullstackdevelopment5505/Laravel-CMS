<div class="modal fade" id="applyReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/textla/addon/review/apply" method="post" class="needs-validation-address" novalidate>                           
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row"> 
                        <div class="form-group col-md-6">
                            <input type="hidden" value="{{$order['id']}}" name="orderid">
                            <input type="hidden" value="{{$order['user_id']}}" name="userid">
                            <label for="city">Rating</label>
                            <select id="rating" name="rating" class="form-control" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>                                      
                        <div class="form-group col-md-6">
                            <label for="address">Review</label>
                            <textarea name="review" id="review" cols="20" class="form-control" required></textarea>                   
                        </div>       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>