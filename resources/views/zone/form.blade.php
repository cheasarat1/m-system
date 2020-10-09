@csrf
<div class="form-group">
    <label for="name">{{ trans('zone.name') }}</label>
    <input type="text" name="name" id="name" value="{{ $zone->name ?? '' }}" class="form-control" autocomplete="off">
</div>

<div class="form-group">
    <label for="description">{{ trans('zone.description') }}</label>
    <textarea name="description" id="description" rows="5" class="form-control">{{ $zone->description ?? '' }}</textarea>
</div>