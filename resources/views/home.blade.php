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
                    <div class="card-header"><label for="post">Do you have something to share?</label></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('home') }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" id="post" rows="3" name="post"></textarea>
                                <p class="alert">{{ $errors->first('post') }}</p>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Post</button>
                        </form>
                    </div>
                </div>
                <div>
                    @foreach ($posts as $post)
                        <div class="card">
                            <div class="card-header"><label for="post">{{ $post->user_id}}</label></div>
                            <div class="card-body">
                                <p>{{ $post->created_at }}</p>
                                <p>{!!  $post->post !!}</p>
                                <hr/>
                                <div class="row">
                                    <div class="col-9">
                                        @if(Auth::user()->likes()->where('likeable_id', $post->id)->value('likeable_id') !== $post->id)
                                            <form method="POST" action="{{'/like/'. $post->id}}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary mb-2">Like</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{'/like/'. $post->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary mb-2">unlike</button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="col-3">
                                        @if(Auth::user()->id === $post->user_id)
                                            <form method="POST" action="{{route('deletePost', $post->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary mb-2">Delete</button>
                                            </form>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
