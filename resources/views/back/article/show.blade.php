@extends('back/layouts/template')

@section('title', 'Detail Artikel - Admin')

@section('content')


    {{-- konten --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Detail Postingan</h1>
        </div>

        <div class="mt-3">
            <table class="table table-striped table-bordered">
                <tr>
                    <th width="250px">
                        Mata Pelajaran
                    </th>
                    <td>: {{ $article->title }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>: {{ $article->Category->name }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>: {!! $article->desc !!}</td>
                </tr>
                <tr>
                    <th>Link Grup WhatsApp</th>
                    <td>:
                        @if ($article->group)
                            <a href="{{ $article->group }}" target="_blank">Silahkan Klik Untuk Bergabung</a>
                        @else
                            <span class="badge bg-secondary">Belum tersedia</span>
                        @endif
                    </td>
                </tr>


                <tr>
                    <th>Image</th>
                    <td>:
                        <a href="{{ asset('storage/back/' . $article->img) }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('storage/back/' . $article->img) }}" alt="gambar artikel" width="50%">
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Views</th>
                    <td>: {{ $article->views }}x</td>
                </tr>
                <tr>
                    <th>Status</th>
                    @if ($article->status == 1)
                        <td>: <span class="badge bg-success">Published</span></td>
                    @else
                        <td>: <span class="badge bg-danger">Private</span></td>
                    @endif
                </tr>
                <tr>
                    <th>Publish Date</th>
                    <td>: {{ $article->publish_date }}</td>
                </tr>
            </table>

            <div class="float-end">
                <a href="{{ url('article') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>


    @endsection
