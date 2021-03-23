@foreach($childs as $child)
    <tr class="treegrid-{{$child->id}} treegrid-parent-{{$child->parent_id}}">
        <td>{{ $child->category_name }}</td>
        <td>
         <img src="<?php echo asset('/').'public'?>/{{$child->category_url}}" class="category-image img-responsive img-fluid" >
        </td>
         <td>
             <a href="<?php echo asset('/').'textla/category/update?id='?>{{ $child->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
             <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$child->id}})" data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
         </td>
    </tr>
    @if(count($child->children))
        @include('admin.part.manage_child',['childs' => $child->children])
    @endif
@endforeach