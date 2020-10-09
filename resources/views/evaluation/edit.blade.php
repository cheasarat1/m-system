@extends('layouts.app')

@section('content')
	<form method="PATCH" action="{{ route('evaluation.update',  $evaluation->id) }}" id="form_evaluation">
		@method('PATCH')
	    @include('evaluation.form')
	</form>
@endsection