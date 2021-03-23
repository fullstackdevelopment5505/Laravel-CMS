@if(sizeof($pages) !== 0)
    @foreach($pages as $row)
    <tr>
        <td>{{ $row->page_title}}</td>
        <td>
            <a href="<?php echo asset('/').'textla/page/update?id='?>{{ $row->id }}"
                class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                @if($row->default == 0) 
            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->id}})" data-target="#DeleteModal"
                class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                @endif
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
@if($pages->hasPages())
<td colspan="2" align="center">
{!! $pages->links() !!}
</td>
@endif
</tr>