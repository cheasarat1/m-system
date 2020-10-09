@csrf
<div class="form-group">
    <label>{{ trans('village.province_id') }}</label>
    <select name="province_id" data-url="{{ url('/') }}/province/select2" class="form-control" style="width: 100%">
		@isset($village)
			<option value="{{ $village->commune->district->province->id }}">{{ $village->commune->district->province->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label>{{ trans('village.district_id') }}</label>
    <select name="district_id" data-url="{{ url('/') }}/district/select2" class="form-control" style="width: 100%">
		@isset($village)
			<option value="{{ $village->commune->district->id }}">{{ $village->commune->district->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label>{{ trans('village.commune_id') }}</label>
    <select name="commune_id" data-url="{{ url('/') }}/commune/select2" class="form-control" style="width: 100%">
		@isset($village)
			<option value="{{ $village->commune->id }}">{{ $village->commune->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label for="name">{{ trans('village.name') }}</label>
    <input type="text" name="name" id="name" value="{{ $village->name ?? '' }}" class="form-control" autocomplete="off">
</div>