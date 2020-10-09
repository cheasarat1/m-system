@csrf
<div class="form-group">
    <label for="username">{{ trans('district.province_id') }}</label>
    <select name="province_id" data-url="{{ url('/') }}/province/select2" class="form-control" style="width: 100%">
		@isset($district)
			<option value="{{ $district->province->id }}">{{ $district->province->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label for="username">{{ trans('district.name') }}</label>
    <input type="text" name="name" id="name" value="{{ $district->name ?? '' }}" class="form-control" autocomplete="off">
</div>