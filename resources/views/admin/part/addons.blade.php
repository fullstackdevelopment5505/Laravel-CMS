@if(sizeof($addons) !== 0)
    @foreach($addons as $row)
        <tr>
            <td>{{$row->add_on_name}}</td> 
            <td>
                @if($row->status == 0)
                    <a id="{{$row->id}}" val="{{$row->status == 0 ? 1 : 0 }}" href="javascript:;" class="btn btn-xs btn-danger status-button">Activate</a>
                @else
                    <a id="{{$row->id}}" val="{{$row->status == 0 ? 1 : 0 }}" href="javascript:;" class="btn btn-xs btn-danger status-button">Deactivate</a>
                @endif
            </td>
        </tr>
    @endforeach
@else
<tr>
    <td colspan="2" align="center">
        <h4 class="text-center">No Addon Available</h4>
    </td>
</tr>
@endif
<tr>
</tr>