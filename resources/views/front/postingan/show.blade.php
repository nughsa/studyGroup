@extends('front.layout.template')

@section('title', $postingan->title . ' - Postingan StudyGroup')
@section('content')
    <!-- Page content-->
    <div class="container mt-3">
        <div class="row show">
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <a href="{{ url('p/' . $postingan->slug) }}">
                        <img class="card-img-top single-img" src="{{ asset('storage/back/' . $postingan->img) }}"
                            alt="{{ $postingan->title }}" />
                    </a>
                    <div class="card-body">
                        <div class="small text-muted">
                            <span class="ml-2">
                                {{ $postingan->created_at->format('d-m-Y') }}
                            </span>
                            <span class="ml-2">
                                <a
                                    href="{{ url('category/' . $postingan->Category->slug) }}">{{ $postingan->Category->name }}</a>
                            </span>
                            <span class="ml-2">
                                {{ $postingan->views }}x<i class="bi bi-eye"></i>
                            </span>
                        </div>
                        <h1 class="card-title">{{ $postingan->title }}</h1>
                        <p class="card-text">{!! $postingan->desc !!} <br>
                            <a href="{{ $postingan->group }}" target="_blank" class="btn btn-success btn-sm mt-2">
                                Join WhatsApp Group
                            </a>
                        </p>
                        <a href="{{ url('/') }}" class="btn btn-secondary btn-sm mb-3">Lihat Lainnya</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
