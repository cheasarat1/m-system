@extends('layouts.app')

@section('content')
	<form method="POST" action="{{ route('evaluation.store') }}" id="form_evaluation">
	    @include('evaluation.form')
	</form>
@endsection