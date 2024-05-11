@extends('layouts.template')

@section('modal')
    @include('artikel.modal.report')
@endsection

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
                <div class="col-md-12">
                    <div class="card border-0">
                        {{-- <form action="{{ route('artikel.store') }}" method="post" enctype="multipart/form-data"> --}}
                            {{-- @csrf
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Informasi Artikel
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="input-group">
                                            <label class="input-group-text" for="tanggal">Tanggal</label>
                                            <input type="text" class="form-control" required name="tanggal" value="{{ date('d F Y', strtotime($data->tanggal_artikel)) }}" placeholder="Tanggal Artikel">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="card-body border-0">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4><b>{{ $data->judul }}</b></h4>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        {!! $data->teks_artikel !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-0">
                                <p>{{ date('d F Y', strtotime($data->tanggal_artikel)) }}</p>
                                <a href="{{ route('artikel.index') }}">
                                    <button class="btn btn-success">Kembali</button>
                                </a>
                                @if (auth()->check())
                                    @if (auth()->user()->role != 'Admin')
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" >Report</button>
                                    @else
                                        <a href="{{ route('artikel.edit', $data->id) }}">
                                            <button class="btn btn-primary">Ubah</button>
                                        </a>
                                    @endif
                                @else
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" >Report</button>
                                @endif
                                {{-- <button class="btn btn-success" type="submit">
                                    Simpan
                                </button> --}}
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection