<div class="modal-header header-color-modal bg-color-2">
    <h4 class="modal-title">{{ $user->fullname }}</h4>
</div>
<div class="modal-body" id="view-profile-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Member Id</label>
                <p>{{ $user->memberid }}</p>
            </div>
            <div class="form-group">
                <label>Email (Primary)</label>
                <p>{{ $user->email }}</p>
            </div>
            <div class="form-group">
                <label>Mobile (Primary)</label>
                <p>{{ $user->mobile_primary }}</p>
            </div>
            <div class="form-group">
                <label>Address</label>
                <p>{{ $user->address }} {{$user->zipcode ? ', '. $user->zipcode : ''}}</p>
            </div>
             <div class="form-group">
                <label>State</label>
                <p>{{ $user->state }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Date of Birth</label>
                <p>{{ $user->dateofbirth }}</p>
            </div>
            <div class="form-group">
                <label>Email (Personal)</label>
                <p>{{ $user->email_personal }}</p>
            </div>
            <div class="form-group">
                <label>Mobile (Primary)</label>
                <p>{{ $user->mobile_personal }}</p>
            </div>
             <div class="form-group">
                <label>City</label>
                <p>{{ $user->city }}</p>
            </div>
            <div class="form-group">
                <label>Country</label>
                <p>{{ $user->country }}</p>
            </div>
            
        </div>
    </div>
</div>
<div class="modal-footer info-md">
    <a data-dismiss="modal" href="#">Cancel</a>
</div>