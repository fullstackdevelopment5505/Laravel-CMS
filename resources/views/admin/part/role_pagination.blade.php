@if(sizeof($roles) !== 0)
    @foreach($roles as $row)
    <tr>
        <td>{{ $row->name}}</td>
        <td><i class="fa fa-eye cursor-pointer view_roleDetail" id="{{ $row->id }}"></i></td>
        <td>
            <a href="<?php echo asset('/').'textla/role/edit?id='?>{{ $row->id }}"
                class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>               
            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->id}})" data-target="#DeleteModal"
                class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
              
        </td>
    </tr>
    @endforeach
@else
<tr>
    <td colspan="5" align="center">
        <h4 class="text-center">No Data Available</h4>
    </td>
</tr>
@endif
<tr>
@if($roles->hasPages())
<td colspan="2" align="center">
{!! $roles->links() !!}
</td>
@endif
</tr>