<?php

namespace App\Http\Controllers\Front;

use App\Models\Postingan;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostinganController extends Controller
{
    public function show($slug)
    {
        return view('front.postingan.show', [
            'postingan' => Postingan::whereSlug($slug)->first(),
            'categories' => Category::latest()->get()
        ]);
    }
}
