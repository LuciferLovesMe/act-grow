@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>{{ $data->sertifikasi }}</h3>
                </div>
                <div class="col-md-12 text-center">
                    <img src="" alt="">
                </div>
                <div class="col-md-12 text-center">
                    <a href="{{ route('download-ketentuan-sertifikasi', $data->id) }}" class="btn btn-success">
                        Lihat Ketentuan
                    </a>
                    @if ($canEdit)
                        <a href="{{ route('sertifikasi-lembaga.edit', $data->id) }}" class="btn btn-success">
                            Ubah
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush