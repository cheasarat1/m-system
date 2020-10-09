<form method="POST" action="{{ route('user.update',  $user->id) }}" id="form_user">
	@method('PATCH')
    @include('user.form')
</form>