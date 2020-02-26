@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                    <div class="card-header">
                        <div class="row" id="head-info">
                            <div class="col">
                                <img src="../../storage/app/public/img/default.jpeg" width="90px">
                                <h3>{{ $user->name . " " . $user->surname }}</h3>

                            </div>
                            <div class="col-6">
                                <p>{{ $user->bio }}</p>
                                <button type="submit" class="btn btn-primary">Add Friend</button>
                                <button type="submit" class="btn btn-primary">Fallow</button>
                            </div>
                            <div class="col">
                               <p>Birth of date: {{ $user->birthday }}</p>
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

                    Here will be users galleries

                </div>
            </div>
            <div class="col-6">
                <div>
                    @foreach ($posts as $post)
                        <div class="card">
                            <div class="card-header"><label for="post">{{$post->user_id}}</label></div>
                            <div class="card-body">
                                <p>{{ $post->created_at }}</p>
                                <p>{!!  $post->post !!}</p>
                                <div class="row">
                                    <div class="col-9">
                                        Like button
                                    </div>
                                    <div class="col-3">
                                        @if(Auth::check())
                                            <form method= "POST" action="{{'/home/delete/'. $post->id}}" >
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

                    <div class="card-body">

                        At the moment not selling your data to third parties.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
