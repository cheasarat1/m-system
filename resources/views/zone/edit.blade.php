<form method="POST" action="{{ route('zone.update',  $zone->id) }}" id="form_zone">
	@method('PATCH')
    @include('zone.form')
</form>