<?php

namespace App\Http\Controllers\Back;

use App\Models\Category;
use App\Models\Postingan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostinganRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdatePostinganRequest;

class PostinganController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $postingan = Postingan::with(['Category', 'user'])->latest();

            if (Auth::user()->name !== 'Admin Study Group') {
                $postingan->where('user_id', Auth::id());
            }

            return DataTables::of($postingan)
                ->addIndexColumn()
                ->addColumn('name', function ($postingan) {
                    return $postingan->user ? $postingan->user->name : '-';
                })
                ->addColumn('category_id', function ($postingan) {
                    return $postingan->Category->name;
                })
                ->addColumn('status', function ($postingan) {
                    if ($postingan->status == 0) {
                        return '<span class="badge bg-danger">Private</span>';
                    } else {
                        return '<span class="badge bg-success">Published</span>';
                    }
                })
                ->addColumn('button', function ($postingan) {
                    return '<div class="text-center">
                                <a href="postingan/' . $postingan->id . '" class="btn btn-info">Detail</a>
                                <a href="postingan/' . $postingan->id . '/edit" class="btn btn-primary">Edit</a>
                                <a href="#" onClick="deletePostingan(this)" data-id="' . $postingan->id . '" class="btn btn-danger">Hapus</a>
                            </div>';
                })
                ->rawColumns(['category_id', 'status', 'button'])
                ->make();
        }

        return view('back.postingan.index');
    }

    public function create()
    {
        return view('back.postingan.create', [
            'categories' => Category::get(),
        ]);
    }

    public function store(PostinganRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('img');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('back', $fileName, 'public');

        $data['img'] = $fileName;
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = Auth::user()->id;
        // 📝 Tambahkan user_id

        Postingan::create($data);

        return redirect(url('postingan'))->with('success', 'Data artikel berhasil ditambahkan');
    }

    public function show(string $id)
    {
        return view('back.postingan.show', [
            'postingan' => Postingan::find($id)
        ]);
    }

    public function edit(string $id)
    {
        return view('back.postingan.update', [
            'postingan' => Postingan::find($id),
            'categories' => Category::get()
        ]);
    }

    public function update(UpdatePostinganRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('back', $fileName, 'public');

            Storage::disk('public')->delete('back/' . $request->oldImg);
            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }

        $data['slug'] = Str::slug($data['title']);

        // Pertahankan user_id yang asli
        $postingan = Postingan::find($id);
        $data['user_id'] = $postingan->user_id;

        $postingan->update($data);

        return redirect(url('postingan'))->with('success', 'Data artikel berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $data = Postingan::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data artikel tidak ditemukan'
            ], 404);
        }

        if ($data->img && Storage::disk('public')->exists('back/' . $data->img)) {
            Storage::disk('public')->delete('back/' . $data->img);
        }

        $data->delete();

        return response()->json([
            'message' => 'Data artikel berhasil dihapus'
        ]);
    }
}
