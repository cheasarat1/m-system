<form method="POST" action="{{ route('village.update',  $village->id) }}" id="form_village">
	@method('PATCH')
    @include('village.form')
</form>