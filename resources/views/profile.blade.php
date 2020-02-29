@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card-header">
                    <div class="row" id="head-info">
                        <div class="col">
                            <img src="{{ asset("storage/". $user->img_location) }}" width="120px">
                            <h3>{{ $user->name . " " . $user->surname }}</h3>
                        </div>
                        <div class="col-6">
                            <p>{{ $user->bio }}</p>
                        </div>
                        <div class="col">
                            <p>Email: {{ $user->email }}</p>
                            <p>Phone number: {{ $user->phone_number }}</p>
                            <p>Address: {{ $user->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <h5>Galleries</h5>
                    @foreach($allGalleries as $gallery)
                        <div class="col-4">
                            <a href="{{ route('galleryShow', $gallery->id) }}"><img src="{{ asset("storage/" . "default.jpg") }}" width="90px"></a>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-6">
                <div>
                    @foreach ($posts as $post)
                        <div class="card">
                            <div class="card-header"><label for="post">{{$user->name ." " . $user->surname}}</label></div>
                            <div class="card-body">
                                <p>{{ $post->created_at }}</p>
                                <p>{!!  $post->post !!}</p>
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
                                    <div class="col-3">
                                        @if(Auth::user()->id === $user->id)
                                            <form method="POST" action="{{'/home/delete/'. $post->id}}">
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
                    @if(Auth::user()->id !== $user->id)
                        <div class="card-header">
                            @if(Auth::user()->pendingInvitations()->where('pending_friend_id', $user->id)->value('pending_friend_id') !== $user->id)
                                <form method="POST" action="{{ '/profile/friend/' . $user->id }}">
                                    @csrf
                                    <button type="submit" name="friend" class="btn btn-primary">Add Friend</button>
                                </form>
                            @elseif(Auth::user()->friends()->where('friend_id', $user->id)->value('friend_id') == $user->id)
                                <form method="POST" action="{{ '/profile/friend/' . $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="friend" class="btn btn-primary">UnFriend</button>
                                </form>
                            @endif
                            @if(Auth::user()->following()->where('following_to_id', $user->id)->value('following_to_id') !== $user->id)
                                <form method="POST" action="{{ '/profile/' . $user->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Follow</button>
                                </form>
                            @else
                                <form method="POST" action="{{route('deletePost', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">Unfollow</button>
                                </form>
                            @endif
                        </div>
                    @endif
                    <div class="card-body">
                        <p>Here will be visible friends</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
