@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    <h4><b>{{ $dataSertifikasi->sertifikasi }}</b></h4>
                    <hr>
                    <h1><i class="fa fa-file"></i></h1>
                </div>
                <div class="col-md-12 text-center">
                    <a href="{{ route('download-ketentuan-sertifikasi', $dataSertifikasi->id) }}">
                        <p>Download Berkas Disini <span><i class="fa fa-arrow-down"></i></span></p>
                    </a>
                    <a href="{{ route('upload-ketentuan') }}?id={{ $dataSertifikasi->id }}">
                        <p>Upload Berkas Disini <span><i class="fa fa-arrow-up-from-bracket"></i></span></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush