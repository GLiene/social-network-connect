@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <img src="{{ asset("storage/". Auth::user()->img_location) }}" width="90px">
                    <h3>{{Auth::user()->name . " " . Auth::user()->surname }}</h3>
                </div>

                <nav class="navbar  navbar-dark bg-dark sidebar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('profile', Auth::user()->id) }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('editForm') }}">Edit profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('galleriesShow') }}">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('friendsAndPending') }}">Friends</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('following') }}">Following</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header"><label for="post">You are following to:</label></div>
            </div>
            @foreach($followingAll as $followingOne)
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset("storage/". $followingOne->img_location) }}" width="90px">
                    <a href="{{ 'profile/' . $followingOne->id }}">{{ $followingOne->name }}</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">Advertisements</div>
                At the moment not selling your data to third parties.
            </div>
        </div>
    </div>
</div>

@endsection
