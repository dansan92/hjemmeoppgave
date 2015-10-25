@extends('app')

@section('title')
    Om Daniel
@stop

@section('content')
	<h1>Om {{ $name }}</h1>
	<p>Hjemmeoppgave utført av {{ $name }} :)</p>
	<p>{{ $name }} er en nyutdannet dataingeniør som liker webutvikling.<br/>For mer info, sjekk <a target="_blank" href="https://no.linkedin.com/in/danielsandnes">LinkedIn</a>.</p>
@stop