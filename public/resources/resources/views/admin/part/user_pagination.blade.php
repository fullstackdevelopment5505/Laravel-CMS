@if(sizeof($users) !== 0)
    @foreach($users as $row)
    <tr>
    <td>{{ $row->memberid}}</td>
    <td>{{ $row->fullname }}</td>
    <td>{{ $row->email }}</td>
    <td>{{ $row->country }}</td>
    <td>
        <i class="fa fa-eye cursor-pointer view_user" id="{{ $row->id }}"></i>
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
<td colspan="5" align="center">
{!! $users->links() !!}
</td>
@endif
</tr>