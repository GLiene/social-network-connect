<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{

    public function allGalleries()
    {
        $allGalleries = Gallery::where(['user_id' => Auth::user()->id])->get();


        return view('galleries.galleriesView', compact('allGalleries'));
    }

    public function show(Gallery $gallery)
    {
        $allImages = Image::where(['gallery_id' => $gallery->id])->get();

        return view('galleries.gallery', ['allImages' => $allImages, 'gallery' => $gallery]);
    }


    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:100']
        ]);

        Gallery::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title')
        ]);

        return redirect('galleries');

    }


    public function deleteGallery(Gallery $gallery)
    {
        Gallery::where('id', $gallery->id)->delete();

        return redirect('/galleries');
    }

}
