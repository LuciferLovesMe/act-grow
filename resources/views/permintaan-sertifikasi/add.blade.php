@extends('layouts.template')

@section('hero')
    <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <p style="color: white">Layanan</p>
        <hr style="background-color: white; color: white">
        <h3 style="color: white">{{ ucwords($data->nama_lembaga) }}</h3>
    </div>
    </section>
@endsection

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    <h3>{{ $data->sertifikasi }}</h3>
                    <hr>
                </div>
                <div class="col-md-12 text-center mt-3">
                    <h1 class="fs-1"><i class="fa fa-file fa-2xl"></i></h1>
                </div>
                <div class="col-md-12 text-center mt-3">
                    <a href="{{ route('download-ketentuan-sertifikasi', $dataSertifikasi->id) }}">
                        <p>Download Template Berkas <span><i class="fa fa-arrow-down"></i></span></p>
                    </a>
                    @if (auth()->check())
                        @if (auth()->user()->role == 'Petani')
                            <a href="{{ route('upload-ketentuan') }}?id={{ $dataSertifikasi->id }}">
                                <p>Upload Berkas Disini <span><i class="fa fa-arrow-up-from-bracket"></i></span></p>
                            </a>
                        @endif
                    @else
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush