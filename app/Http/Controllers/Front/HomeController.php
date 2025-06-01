<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postingan;

class HomeController extends Controller
{
    public function index()
    {
        $keyword = request()->keyword;
        if ($keyword) {
            $postingans = Postingan::with('Category')
                ->whereStatus(1)
                ->where('title', 'like', '%' . $keyword . '%')
                ->latest()
                ->simplePaginate(6);
        } else {
            $postingans = Postingan::with('Category')->whereStatus(1)->latest()->simplePaginate(6);
        }

        return view('front.home.index', [
            'latest_post' => Postingan::latest()->first(),
            'postingans' => $postingans,
            'categories' => Category::latest()->get()
        ]);
    }
}
