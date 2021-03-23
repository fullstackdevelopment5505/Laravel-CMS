@if(sizeof($products) !== 0)
@foreach($products as $row)
<tr>
    <td>{{ $row->product_name}}</td>
    <td>{{ $row->product_sku }}</td>  
    <td><img src="<?php echo asset('/').'public'?>/{{$row->media_url}}" class="category-image img-responsive img-fluid" ></td>
                                                  
    <td>{{$currency}}{{ $row->total_cost }}{{$currType}}</td>
    <td>{{ $row->product_quantity }}</td>
    <td>
    <a href="javascript:;" id="{{$row->id}}" value1="{{$row->on_deal}}" class="btn btn-xs btn-primary on_deal"><?php if($row->on_deal == 1){echo 'YES';}else{echo 'NO';}?></a>
    </td>
    <td>
    <a href="javascript:;" id="{{$row->id}}" col="on_home" class="btn btn-xs btn-primary Value_Set"><?php if($row->on_home == 1){echo 'YES';}else{echo 'NO';}?></a>
    </td>
    <td>
    <a href="javascript:;" id="{{$row->id}}" col="on_sale" class="btn btn-xs btn-success Value_Set"><?php if($row->on_sale == 1){echo 'YES';}else{echo 'NO';}?></a>   
    </td>
    <td>
    
        <a href="<?php echo asset('/').'textla/product/update?id='?>{{ $row->id }}"
            class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->id}})" data-target="#DeleteModal"
            class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
   
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="6" align="center">
        <h4 class="text-center">No Data Available</h4>
    </td>
</tr>
@endif
<tr>
@if($products->hasPages())
<td colspan="6" align="center">
{!! $products->links() !!}
</td>
@endif
</tr>