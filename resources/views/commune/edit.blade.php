<form method="POST" action="{{ route('commune.update',  $commune->id) }}" id="form_commune">
	@method('PATCH')
    @include('commune.form')
</form>