@extends('app')

@section('title')
    Registrer
@stop

@section('content')
    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

        <div>
            E-post
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            Passord (min. 6 tegn)
            <input type="password" name="password">
        </div>

        <div>
            Bekreft passord
            <input type="password" name="password_confirmation">
        </div>

        <div>
            <button type="submit">Registrer</button>
        </div>
    </form>
@stop