@csrf
<div class="form-group">
    <label for="username">{{ trans('province.name') }}</label>
    <input type="text" name="name" id="name" value="{{ $province->name ?? '' }}" class="form-control" autocomplete="off" autofocus>
</div>