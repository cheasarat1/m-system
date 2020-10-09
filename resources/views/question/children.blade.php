<option value="{{ $children->id }}" <?php echo (isset($editQuestion)) ? ($children->id == $editQuestion->question_id) ? 'selected' : '' : '' ; ?>>
	<?php echo $spaces.$children->name; ?>
</option>
@if (count($children->questions))
	@php $spaces.= '&#160;&#160;&#160;' @endphp
	@foreach ($children->questions as $children)
    	@include('question.children', [
    		'children' => $children,
    		'spaces' => $spaces
    	]) 
    @endforeach
@endif