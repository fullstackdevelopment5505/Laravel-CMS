<div class="modal-header header-color-modal bg-color-1">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ $role->name }}</h4>
</div>
<div class="modal-body" id="view-role-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Role Name</label>
                <p>{{ $role->name }}</p>
            </div>
            <div class="form-group">
                <label>Role Description</label>
                <p>{{ $role->description }}</p>
            </div>
            <hr>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User List</th>                       
                    </tr>
                </thead>
                    <tbody>
                    @foreach($user as $row)
                    <tr>
                    <th>{{$row->fullname}}</th>
                    </tr>
                    @endforeach

                    
                    <th> @if($user->count() == 0)
                       <span>
                        No User List Found
                       </span>
                    @endif</th>
                   
                    
                    </tbody>  
            </table>      
            
        </div>
        <div class="col-md-6">                       
                <input type="text" style="opacity:0;" placeholder="Role Name" name="permissions"
                    value="{{$role->permissions}}" id="permissions">
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Module Name</th>
                        <th>Read Permission</th>
                        <th>Write Permission</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modules as $module)
                    <tr>
                        <th>{{$module->module_name}}</th>
                        <th>
                            
                                <span class="read_check" access="{{$module->id}}" id="check_{{$module->id}}"></span>
                        </th>
                        <th>                       
                                <span class="write_check" access="{{$module->write_access}}"
                                id="check_write_{{$module->id}}"> </span>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="modal-footer info-md">
    <a data-dismiss="modal" href="#">Cancel</a>
</div>
<script>
$(document).ready(function() {    
    let permissions = $("#permissions").val();
    if (permissions) {
        let permissionsData = permissions.split(",");
        $(".read_check").each(function() {
            console.log(jQuery.inArray($(this).attr("access"), permissionsData));
            if (jQuery.inArray($(this).attr("access"), permissionsData) != -1) {               
                $(this).text('YES');

               // $("#check_write_" + $(this).attr("access")).removeAttr("disabled");
            }
        });
        $(".write_check").each(function() {
            if (jQuery.inArray($(this).attr("access"), permissionsData) != -1) {
                //$(this).attr("checked", "checked");
                $(this).text('YES');
            }
        });
        console.log(permissionsData);
    }
});
</script>