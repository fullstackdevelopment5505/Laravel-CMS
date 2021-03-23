<div class="modal-header header-color-modal bg-color-2">
    <h4 class="modal-title">{{ $user->fullname }}</h4>
</div>
<div class="modal-body" id="view-profile-body">
    <div class="row">
        <div class="col-md-6">            
            <div class="form-group">
                <label>Email</label>
                <p>{{ $user->email }}</p>
            </div>  
        </div>
        <div class="col-md-6">
        <div class="form-group">
                <label>Mobile</label>
                <p>{{ $user->mobile }}</p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer info-md">
    <a data-dismiss="modal" href="#">Cancel</a>
</div>