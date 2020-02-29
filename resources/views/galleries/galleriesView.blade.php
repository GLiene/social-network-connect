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
                    <div class="card-header">
                        <div >
                            <h3 class="d-flex justify-content-center">Add gallery:</h3>
                        </div>
                        <form method="POST" action="{{ route('galleriesStore') }}">
                            @csrf
                            <div class="form-group">
                                <label for="gallery" >{{ __('Gallery title:') }}</label>
                                <input type="text" class="form-control" id="gallery" name="title" placeholder="Title">
                                <p class="alert">{{ $errors->first('gallery') }}</p>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Create</button>
                        </form>
                        <hr/>
                        <div >
                            <h3 class="d-flex justify-content-center">Your galleries:</h3>
                        </div>
                    </div>
                </div>
                @foreach($allGalleries as $gallery)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset("storage/" . "default.jpg") }}" width="90px">
                                    <a href="{{ 'galleries/' . $gallery->id }}">{{ $gallery->title }}</a>
                                </div>
                                <div class="col-6">
                                    @if(Auth::user()->id === $gallery->user_id)
                                    <form method="POST" action="{{ '/galleries/delete/' . $gallery->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="gallery" class="btn btn-primary">Delete gallery</button>
                                    </form>
                                        @endif
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
    </div>

@endsection
