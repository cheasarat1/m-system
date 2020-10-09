@csrf
<div class="form-group">
    <label for="name">{{ trans('school.name') }}</label>
    <input type="text" name="name" id="name" value="{{ $school->name ?? '' }}" class="form-control" autocomplete="off">
</div>

<div class="form-group">
    <label for="code">{{ trans('school.code') }}</label>
    <input type="text" name="code" id="code" value="{{ $school->code ?? '' }}" class="form-control" autocomplete="off">
</div>

<div class="form-group">
    <label>{{ trans('school.level_id') }}</label>
    <select name="level_id" data-url="{{ url('/') }}/level/select2" class="form-control select2" style="width: 100%">
		@isset($school)
			<option value="{{ $school->level->id }}">{{ $school->level->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label>{{ trans('school.zone_id') }}</label>
    <select name="zone_id" data-url="{{ url('/') }}/zone/select2" class="form-control select2" style="width: 100%">
		@isset($school)
			<option value="{{ $school->zone->id }}">{{ $school->zone->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label>{{ trans('school.province_id') }}</label>
    <select name="province_id" data-url="{{ url('/') }}/province/select2" class="form-control select2" style="width: 100%">
		@isset($school)
			<option value="{{ $school->village->commune->district->province->id }}">{{ $school->village->commune->district->province->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label>{{ trans('school.district_id') }}</label>
    <select name="district_id" data-url="{{ url('/') }}/district/select2" class="form-control select2" style="width: 100%">
		@isset($school)
			<option value="{{ $school->village->commune->district->id }}">{{ $school->village->commune->district->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label>{{ trans('school.commune_id') }}</label>
    <select name="commune_id" data-url="{{ url('/') }}/commune/select2" class="form-control select2" style="width: 100%">
		@isset($school)
			<option value="{{ $school->village->commune->id }}">{{ $school->village->commune->name }}</option>
		@endisset
	</select>
</div>

<div class="form-group">
    <label>{{ trans('school.village_id') }}</label>
    <select name="village_id" data-url="{{ url('/') }}/village/select2" class="form-control" style="width: 100%">
		@isset($school)
			<option value="{{ $school->village->id }}">{{ $school->village->name }}</option>
		@endisset
	</select>
</div>