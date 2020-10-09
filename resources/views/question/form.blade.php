@csrf
<div class="form-group">
    <label>{{ trans('question.name') }}</label>
    <input type="text" name="name" value="{{ $editQuestion->name ?? '' }}" class="form-control" autocomplete="off">
</div>

<div class="form-group">
    <label>{{ trans('question.question_id') }}</label>
    <select name="question_id" class="form-control" style="width: 100%;">
        <option value="0">-</option>
		@foreach($questions as $question)
            <option value="{{ $question->id }}" <?php echo (isset($editQuestion)) ? ($question->id == $editQuestion->question_id) ? 'selected' : '' : '' ; ?>>
                {{ $question->name }}
            </option>
            @foreach ($question->childrenQuestions as $children)
                @include('question.children', [
                    'children' => $children,
                    'spaces' => '&#160;&#160;&#160;'
                ])
            @endforeach
		@endforeach
	</select>
</div>

<div class="form-group">
    <label>{{ trans('question.order') }}</label>
    <input type="text" name="order" value="{{ $editQuestion->order ?? '' }}" class="form-control" autocomplete="off">
</div>