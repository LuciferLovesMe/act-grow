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
                <h4><b>{{ $dataSertifikasi->sertifikasi }}</b></h4>
                <hr>
            </div>
            <div class="col-md-9 text-right d-flex justify-content-end">
                <form action="{{ route('permintaan-sertifikasi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_template_sertifikasi" value="{{ $dataSertifikasi->id }}">
                    <div class="row d-flex justify-content-end">
                        <label for="nama_petani" class="mt-2 col-md-4 col-form-label">Nama</label>
                        <div class="mt-2 col-md-8">
                            <input type="text" disabled class="mt-2 form-control" value="{{ $dataUser->nama_petani }}">
                        </div>
                        <label for="nama_petani" class="mt-2 col-md-4 col-form-label">Sertifikasi</label>
                        <div class="mt-2 col-md-8">
                            <input type="text" disabled class="mt-2 form-control" value="{{ $dataSertifikasi->sertifikasi }}">
                        </div>
                        <label for="nama_petani" class="mt-2 col-md-4 col-form-label">Pilih File ZIP atau RAR</label>
                        <div class="mt-2 col-md-8">
                            <input type="file" class="mt-2 form-control" name="file_ketentuan">
                        </div>
                        <div class="col-md-4 mt-3 text-right d-flex justify-content-end">
                            <a href="{{ route('permintaan-sertifikasi.create') }}?id={{ $dataSertifikasi->id }}">
                                <button class="btn btn-secondary mr-1" type="button">Batal</button>
                            </a>
                            <button class="btn btn-success ml-1" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
    
@endpush