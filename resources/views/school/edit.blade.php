<form method="POST" action="{{ route('school.update',  $school->id) }}" id="form_school">
	@method('PATCH')
    @include('school.form')
</form>