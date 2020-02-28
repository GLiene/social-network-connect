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
                                <a class="nav-link" href="{{'profile/' . Auth::user()->id }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{'edit/' }}">Edit profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ 'friends' }}">Friends</a>
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
                    <div class="card-header">
                        <div >
                            <h3 class="d-flex justify-content-center">{{ $gallery->title }}</h3>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{!! route('gallery', $gallery->id) !!}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <p >Select image to upload:</p>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" class="form-control-file" name="image" id="fileToUpload" >
                                    <input type="submit" class="btn btn-primary" name="uploadImage" value="Upload Image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('image') }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @foreach($allImages as $image)
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card-body">
                                    <img src="{{ asset("storage/". $image->img_location) }}" width="90px">
                                </div>
                            </div>
                            <div class="col-6">
                                <form method="POST" action="{{ '/gallery/' . $image->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="gallery" class="btn btn-primary ">Delete image</button>
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
