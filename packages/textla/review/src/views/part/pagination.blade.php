@if(sizeof($pages) !== 0)
    @foreach($pages as $row)
    <tr>
        <td>{{ $row->review_person_name}}</td>
        <td>{{ $row->rating_star}}</td>
        <td>{{ $row->review_comment}}</td>
        <td>{{ $row->product_name}}</td> 
        <td>
            <a href="javascript:;" id="{{$row->id}}" val="{{{$row->show_home == 0 ? 1 : 0 }}}" class="btn btn-xs btn-primary show_home"><?php if($row->show_home == 1){echo 'YES';}else{echo 'NO';}?></a>
        </td>
        <td>{{{ $row->status == '0' ? 'Pending' : ($row->status == '1' ? 'Approved' : 'Rejected') }}}</td>
        <td>
            @if($row->status != '1' ) 
                <a href="javascript:;" id="{{$row->id}}" val="1" class="btn btn-primary btn-xs status"><i class="fa fa-check"></i></a>
                <a href="javascript:;" id="{{$row->id}}" val="2" class="btn btn-xs btn-danger status"><i class="fa fa-times"></i></a>
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