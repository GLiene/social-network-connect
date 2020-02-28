<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function uploadImage(Request $request, Gallery $gallery)
    {
        if(request()->hasFile("image")){
            Image::create([
                'user_id' => Auth::user()->id,
                'gallery_id' => $gallery->id,
                'img_location' => request()->image->store("img","public"),
            ]);
        }

        return back()->with('message', 'Image Uploaded');
    }

    public function deleteImage(Image $image)
    {
        Image::where('id', $image->id)->delete();

        return back();
    }
}
