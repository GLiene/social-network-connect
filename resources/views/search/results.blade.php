@extends('layouts.app')

@section('content')
    <h3>Your search for {{ Request::input('searchQuery') }}:</h3>
    @foreach($users as $user)
    {{ $user->name }}
    {{ $user->bio }}
    @endforeach

@endsection
