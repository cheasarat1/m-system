<form method="POST" action="{{ route('level.update',  $level->id) }}" id="form_level">
	@method('PATCH')
    @include('level.form')
</form>