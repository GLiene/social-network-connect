@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <img src="../../storage/app/public/img/default.jpeg">
                        {{Auth::user()->name . " " . Auth::user()->surname }}

                    </div>

                    <nav class="navbar  navbar-dark bg-dark sidebar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ '#' }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ '#' }}">Edit profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Friends</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Following/Followers</a>
                            </li>
                        </ul>
                    </nav>
                    Here will be users galleries

                </div>
            </div>
            <div class="col-6">
                <form method="POST" action="{{ url('/edit') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="{{ $user->surname }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone_number }}">
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3">{{ $user->bio }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>


            <div class="col">
                <div class="card">
                    <div class="card-header">Advertisements</div>

                    <div class="card-body">
                        At the moment not selling your data to third parties.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
