<li>{{ $children->name }}</li>
@if ($children->questions)
<ul>
    @foreach ($children->questions as $children)
    	@include('evaluation.children', ['children' => $children]) 
    @endforeach
</ul>
@endif