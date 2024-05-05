@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h3><b>Daftar Permintaan Sertifikasi</b></h3>
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <div class="col-md-12 mb-3">
                                        Informasi Permintaan Sertifikasi
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" disabled value="{{ $data->nama_petani }}" class="form-control">
                                            <span class="input-group-text"><i class="fa fa-check"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        Kebutuhan Sertifikasi
                                    </div>
                                    <div class="col-auto text-center">
                                        <a href="{{ route('download-ketentuan-petani', $data->id) }}" class="btn btn-secondary mb-3">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <a href="{{ route('show-permintaan-sertifikasi', $data->id_template_sertifikasi) }}">
                                            <button class="btn btn-danger" type="button">
                                                Batal
                                            </button>
                                        </a>
                                        <button class="btn btn-success" type="submit">
                                            Terima
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush