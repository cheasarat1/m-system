<form method="POST" action="{{ route('district.update',  $district->id) }}" id="form_district">
	@method('PATCH')
    @include('district.form')
</form>