@if(sizeof($orders) !== 0)
@foreach($orders as $row)
<tr>
    <td><span class="label label-primary">{{ $row->order_no}}</span></td>
    <td>{{ $row->fullname}}</td>                 
    <td>{{$currency['config_value']}} {{ $row->totalprice}}{{$currType}}</td>    
    <td>{{ $row->created_at}}</td>
    <td>{{ $row->updated_at}}</td>
    <td>
    @if ($row->order_status == 0) 
   <span class="label label-warning">Ordered</span>  
    @elseif ($row->order_status == 1) 
    <span class="label label-primary">Packed</span> 
    @elseif ($row->order_status == 2) 
    <span class="label label-info">Shipped</span>
     @elseif ($row->order_status == 3) 
     <span class="label label-success">Delivered</span>
     @elseif ($row->order_status == 4) 
     <span class="label label-danger">Cancelled</span>
  @else In Process
    @endif
    </td>
    <td ><a href="<?php echo asset('/').'textla/orderview?id='?>{{ $row->order_no}}"><i class="fa fa-eye cursor-pointer " id="1"></i></a>
    </td>
    <td>
        <a href="javascript:;" title="Cancel Order" data-toggle="modal" onclick="deleteData({{ $row->id}})" data-target="#DeleteModal"
            class="btn btn-xs btn-danger"><i class="fa fa-window-close-o"></i></a>
   
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7" align="center">
        <h4 class="text-center">No Data Available</h4>
    </td>
</tr>
@endif
<tr>
@if($orders->hasPages())
<td colspan="7" align="center">
{!! $orders->links() !!}
</td>
@endif
</tr>