@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="card">
                <div class="card-header">Informasi Pengguna</div>
                <div class="card-body">
                    <div id="row-form" class="row">
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label">Nama Lembaga</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Lembaga" value="{{$data->nama_lembaga}}" disabled>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label">Tahun Berdiri</label>
                            <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun Berdiri" value="{{$data->tahun_berdiri}}" disabled>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label">Bukti Akreditasi</label>
                            <div class="input-group">
                                <a href="{{ route('download-bukti-verif-lembaga', $data->id) }}" class="input-group-text" for="inputGroupFile01"><i class="fa fa-file-arrow-down"></i></a>
                                @php
                                    $showFile = '';
                                    if ($data->bukti_akreditasi) {
                                        $fileName = explode('/', $data->bukti_akreditasi);
                                        $showFile = end($fileName);
                                    }
                                @endphp
                                <input type="text" title="{{ $showFile }}" class="form-control custom-file-label" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled value="{{ $showFile }}">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{$data->alamat_lembaga}}" disabled>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label">Deskripsi Lembaga</label>
                            <textarea name="deskripsi" id="" class="form-control" placeholder="Deskripsi Lembaga" disabled>{{$data->deskripsi_lembaga}}</textarea>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label">Foto</label>
                            <div class="input-group">
                                <label class="input-group-text" for="foto">Foto</label>@php
                                $showFile = '';
                                if ($data->foto_lembaga) {
                                    $fileName = explode('/', $data->foto_lembaga);
                                    $showFile = end($fileName);
                                }
                            @endphp
                            <input type="text" title="{{ $showFile }}" class="form-control custom-file-label" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled value="{{ $showFile }}">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" disabled value="{{$data->username}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" disabled value="{{$data->email}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="" class="form-label">No. Telepon</label>
                            <input type="number" name="no_hp" class="form-control" placeholder="No. HP" disabled value="{{$data->no_hp_lembaga}}">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-danger" id="btn-logout">Logout</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        $("#btn-submit").on('click', function(e) {
            e.preventDefault();
            var pass = $("#password").val();
            var confPass = $("#confirm-password").val()
            if(pass && confPass != null) {
                if(confPass != pass) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Konfirmasi Password Anda Salah!",
                        });
                } else {
                    $("#form").submit()
                }
            } else {
                $("#form").submit()
            }
        })      
        $("#btn-logout").on('click', function() {
            Swal.fire({
                title: "Konfirmasi Logout",
                text: "Apakah Anda Yakin Ingin Logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                $("#logout-form").submit()
                }
            });
        })    
    </script>
@endpush