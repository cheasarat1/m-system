@if (count($children->questions) != 0)
	<option value="{{ $children->id }}">
		<?php echo $spaces.$children->name; ?>
	</option>
	@php $spaces.= '&#160;&#160;&#160;' @endphp
	@foreach ($children->questions as $children)
    	@include('report.children', [
    		'children' => $children,
    		'spaces' => $spaces
    	]) 
    @endforeach
@endif