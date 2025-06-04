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
        $postingan = Postingan::whereSlug($slug)->firstOrFail();
        $postingan->increment('views');
        return view('front.postingan.show', [
            'postingan' => $postingan,
            'categories' => Category::latest()->get(),
            'category_navbar' => Category::latest()->take(3)->get()
        ]);
    }
}
