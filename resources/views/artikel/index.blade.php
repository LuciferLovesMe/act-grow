@extends('layouts.template')

@section('hero')
    <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <h3 style="color: white">Artikel</h3>
        {{-- <h1>Welcome to <span>BizLand</span></h1>
        <h2>We are team of talented designers making websites with Bootstrap</h2>
        <div class="d-flex">
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div> --}}
    </div>
    </section>
@endsection

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 my-3">
                    @if (auth()->check())
                        @if (auth()->user()->role == 'Admin')
                            <a href="{{ route('artikel.create') }}">
                                <button class="btn btn-success">Tambahkan Artikel</button>
                            </a>
                            <a href="{{ route('list-report-artikel') }}">
                                <button class="btn btn-danger">Report</button>
                            </a>
                        @endif
                    @endif
                </div>
                @forelse ($data as $item)
                    <div class="col-md-4">
                        <a href="{{ route('artikel.show', $item->id) }}">
                            <div class="card bg-dark text-white" style="">
                                <img src="{{ asset('/upload/' . $item->cover) }}" class="card-img" alt="...">
                                <div class="card-img-overlay">
                                  <h5 class="card-title">{{ $item->judul }}</h5>
                                  <p class="card-text">{{ date('d F Y', strtotime($item->tanggal_artikel)) }}</p>
                                </div>
                              </div>
                        </a>
                    </div>
                @empty
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                            <h5 class="card-title">Tidak ada artikel tersedia.</h5>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection