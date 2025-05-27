<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $article = Article::with('Category')->latest()->get();

            return DataTables::of($article)
                ->addIndexColumn()
                ->addColumn('category_id', function($article){
                    return $article->Category->name;
                })
                ->addColumn('status', function($article){
                    if ($article->status == 0) {
                        return '<span class="badge bg-danger">Private</span>';
                    } else {
                        return '<span class="badge bg-success">Published</span>';
                    }
                })
                ->addColumn('button', function($article){
                    return '<div class="text-center">
                                <a href="article/'.$article->id.'" class="btn btn-info">Detail</a>
                                <a href="article/'.$article->id.'/edit" class="btn btn-primary">Edit</a>
                                <a href="#" onClick="deleteArticle(this)" data-id="'.$article->id.'" class="btn btn-danger">Hapus</a>
                            </div>';
                })
                ->rawColumns(['category_id', 'status', 'button'])
                ->make();
        }

        return view('back.Article.index');
    }

    public function create()
    {
        return view('back.article.create', [
            'categories' => Category::get(),
        ]);
    }

    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('img');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('back', $fileName, 'public');

        $data['img'] = $fileName;
        $data['slug'] = Str::slug($data['title']);

        Article::create($data);

        return redirect(url('article'))->with('success', 'Data artikel berhasil ditambahkan');
    }

    public function show(string $id)
    {
        return view('back.article.show', [
            'article' => Article::find($id)
        ]);
    }

    public function edit(string $id)
    {
        return view('back.article.update', [
            'article' => Article::find($id),
            'categories' => Category::get()
        ]);
    }

    public function update(UpdateArticleRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('back', $fileName, 'public');

            Storage::disk('public')->delete('back/'.$request->oldImg);
            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }

        $data['slug'] = Str::slug($data['title']);

        Article::find($id)->update($data);

        return redirect(url('article'))->with('success', 'Data artikel berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $data = Article::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data artikel tidak ditemukan'
            ], 404);
        }

        if ($data->img && Storage::disk('public')->exists('back/'.$data->img)) {
            Storage::disk('public')->delete('back/'.$data->img);
        }

        $data->delete();

        return response()->json([
            'message' => 'Data artikel berhasil dihapus'
        ]);
    }
}
