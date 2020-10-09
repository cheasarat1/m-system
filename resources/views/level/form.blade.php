@csrf
<div class="form-group">
    <label for="name">Level name</label>
    <input type="text" name="name" id="name" value="{{ $level->name ?? '' }}" class="form-control" autocomplete="off">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="5" class="form-control">{{ $level->description ?? '' }}</textarea>
</div>