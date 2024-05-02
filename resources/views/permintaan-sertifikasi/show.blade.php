@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-8">
                    <h4><b>{{ $data->nama_lembaga }}</b> @if($data->status_verifikasi)<span><i class="fa fa-circle-check"></i></span>@endif</h4>
                    <hr style="">
                    <h6><span><i class="fa fa-map-location-dot"></i></span> {{ $data->alamat_lembaga }}</h6><br>
                    <h6><span><i class="fa-solid fa-phone"></i></span> {{ $data->no_hp_lembaga }}</h6><br>
                    <h6><span><i class="fa-solid fa-paperclip"></i></span> {{ $data->email }}</h6><br>
                    <h5>Started In {{ $data->tahun_berdiri }}</h5>
                </div>
                <div class="col-md-4 text-center">
                    <img src="" alt="" width="100%">
                    <a href="{{ route('lihat-permintaaan') }}" class="btn btn-success">Permintaan Sertifikasi</a>
                </div>
            </div>
        </div>
        <div class="" style="background-color: #f3f3f3">
            <div class="container mt-3">
                <div class="row mt-3">
                    <div class="col-md-8 mt-3">
                        <h4><b>Informasi Tambahan</b></h4>
                        <hr>
                        <p>{{ $data->deskripsi_lembaga }}</p>
                    </div>
                    <div class="col-md-4 mt-3">
                        <h4><b>Layanan yang disediakan</b></h4>
                        <hr>
                        @forelse ($dataSertifikasi as $item)
                            <ul>
                                <li><a href="{{ route('permintaan-sertifikasi.create') }}?id={{ $item->id }}">{{ $item->sertifikasi }}</a></li>
                            </ul>
                        @empty
                            <ul>
                                <li>Tidak Ada Sertifikat Tersedia.</li>
                            </ul>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush