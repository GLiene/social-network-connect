@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <img src="{{ Auth::user()->img_location }}" width="90px">
                        <h3>{{Auth::user()->name . " " . Auth::user()->surname }}</h3>
                    </div>

                    <nav class="navbar  navbar-dark bg-dark sidebar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{'profile/' . Auth::user()->id }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{'edit/' }}">Edit profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Friends</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ 'following' }}">Following</a>
                            </li>
                        </ul>
                    </nav>


                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header"><label for="post">Your search for {{ Request::input('searchQuery') }}:</label></div>
                </div>
                @foreach($users as $user)
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ $user->img_location }}" width="90px">
                            <a href="{{ 'profile/' . $user->id }}">{{ $user->name }}</a>
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
    </div>

@endsection
