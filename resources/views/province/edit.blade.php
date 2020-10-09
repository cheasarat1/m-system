<form method="POST" action="{{ route('province.update',  $province->id) }}" id="form_province">
	@method('PATCH')
    @include('province.form')
</form>