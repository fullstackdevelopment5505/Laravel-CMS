@if(sizeof($messages) !== 0)
    @foreach($messages as $row)
    <tr>
        <td>{{ $row->contact_name}}</td>
        <td>{{ $row->contact_email}}</td>
        <td>{{ $row->message}}</td>        
        <td>{{ $row->created_at}}</td>        
    </tr>
    @endforeach
@else
<tr>
    <td colspan="4" align="center">
        <h4 class="text-center">No Data Available</h4>
    </td>
</tr>
@endif
<tr>
@if($messages->hasPages())
<td colspan="4" align="center">
{!! $messages->links() !!}
</td>
@endif
</tr>