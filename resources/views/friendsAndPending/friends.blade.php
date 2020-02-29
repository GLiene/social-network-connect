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
                    <div class="card-header"><label for="post">Pending Requests:</label></div>
                </div>
                @foreach($pendingFriends as $friend)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset("storage/". $friend->img_location) }}" width="90px">
                                    <a href="{{ 'profile/' . $friend->id }}">{{ $friend->name }}</a>
                                </div>
                                <div class="col">
                                    <form method="POST" action="{{ '/friends/approve/' . $friend->id }}">
                                        @csrf
                                        <button type="submit" name="friend" class="btn btn-primary">Approve friend</button>
                                    </form>
                                    <br/>
                                    <form method="POST" action="{{ '/friends/' . $friend->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="friend" class="btn btn-primary">Delete request</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="card">
                    <div class="card-header"><label for="post">You are friends with:</label></div>
                </div>
                @foreach($allFriends as $friend)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset("storage/". $friend->img_location) }}" width="90px">
                                    <a href="{{ 'profile/' . $friend->id }}">{{ $friend->name }}</a>
                                </div>
                                <div class="col">
                                    <form method="POST" action="{{ '/friends/delete/' . $friend->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="friend" class="btn btn-primary">Delete friend</button>
                                    </form>
                                </div>
                            </div>
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
