@extends('front.layout.template')

@section('content')
    <!-- Page content-->
    <div class="container mt-3">
        <div class="row show">
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <a href="{{ url('p/' . $postingan->slug) }}">
                        <img class="card-img-top single-img" src="{{ asset('storage/back/' . $postingan->img) }}"
                            alt="..." />
                    </a>
                    <div class="card-body">
                        <div class="small text-muted">{{ $postingan->created_at->format('d-m-Y') }}</div>
                        <h1 class="card-title">{{ $postingan->title }}</h1>
                        <p class="card-text">{!! $postingan->desc !!} <br>
                            <a href="{{ $postingan->group }}" target="_blank" class="btn btn-success btn-sm mt-2">
                                Join WhatsApp Group
                            </a>
                        </p>


                    </div>
                </div>

            </div>
            <!-- Side widgets-->
            @include('front.layout.side-widget')
        </div>
    </div>
    </div>
@endsection
