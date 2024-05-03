@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-8">
                    <h4>Layanan Sertifikasi {{ $data->nama_lembaga }}</h4>
                </div>
                <div class="col-md-4">
                    <p>{{ $data->deskripsi_lembaga ?? '-' }}</p>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <p>Layanan yang disediakan</p>
                </div>
                @if ($canEdit)
                    <div class="col-md-1">
                        <a href="{{ route('sertifikasi-lembaga.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                @endif
                <div class="col-md-12">
                    @foreach ($dataSertifikasi as $item)
                        <ul>
                            <li><a href="{{ route('show-detail-sertifikasi', $item->id) }}">{{ $item->sertifikasi }}</a></li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush