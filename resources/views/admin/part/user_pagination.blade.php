@if(sizeof($users) !== 0)
    @foreach($users as $row)
    <tr>
        <td>{{ $row->fullname}}</td>
        <td>{{ $row->email}}</td>
        <td>{{ $row->mobile}}</td>
        <td>{{ $row->name}}</td>
        <td><i class="fa fa-eye cursor-pointer view_user" id="{{ $row->id }}"></i></td>
        <td>
        
            <a href="<?php echo asset('/').'textla/useredit?id='?>{{ $row->id }}"
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
@if($users->hasPages())
<td colspan="2" align="center">
{!! $users->links() !!}
</td>
@endif
</tr>