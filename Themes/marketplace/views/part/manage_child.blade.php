@foreach($childs as $child)
    <li><input type="checkbox" class="category_filter" category="{{ $child->id }}" name="selectedRole">{{ $child->category_name }}
    <ul>
    @if(count($child->children))
        @include('part.manage_child',['childs' => $child->children])
    @endif
    </ul>
    </li>
@endforeach