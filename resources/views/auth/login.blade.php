@extends('app')

@section('title')
    Log Inn
@stop

@section('content')
    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

        <div>
            E-post
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            Passord
            <input type="password" name="password" id="password">
        </div>

        <div>
            <input type="checkbox" name="remember"> Husk meg
        </div>

        <div>
            <button type="submit">Logg inn</button>
        </div>
    </form>
@stop