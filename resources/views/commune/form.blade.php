@csrf
<div class="form-group">
    <label for="province_id">{{ trans('commune.province_id') }}</label>
    <select name="province_id" data-url="{{ url('/') }}/province/select2" class="form-control" style="width: 100%">
		@isset($commune)
			<option value="{{ $commune->district->province->id }}">{{ $commune->district->province->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label for="district_id">{{ trans('commune.district_id') }}</label>
    <select name="district_id" data-url="{{ url('/') }}/district/select2" class="form-control" style="width: 100%">
		@isset($commune)
			<option value="{{ $commune->district->id }}">{{ $commune->district->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label for="name">{{ trans('commune.name') }}</label>
    <input type="text" name="name" id="name" value="{{ $commune->name ?? '' }}" class="form-control" autocomplete="off">
</div>