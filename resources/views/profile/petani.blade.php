@extends('layouts.template')

@section('content')
    <div class="inner-page mt-3 mb-3">
        <div class="container">
            <div class="card m-3">
                <div class="card-header">Informasi Pengguna</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="row-form" class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Petani" disabled value="{{ $data->nama_petani }}">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="" class="form-label">Jenis Petani</label>
                                    <select name="jenis_petani" id="" class="form-control" disabled>
                                        <option value="">-- Jenis Petani --</option>
                                        <option @selected($data->jenis_petani == 'individu') value="individu">Individu</option>
                                        <option @selected($data->jenis_petani == 'kelompok tani') value="kelompok tani">Kelompok Tani</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="" class="form-label">No. Telepon</label>
                                    <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="{{ $data->no_hp_petani }}" disabled>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="" class="form-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $data->alamat_petani }}" disabled>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $data->username }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 align-items-center justify-content-center align-middle">
                            <div class="row align-items-center justify-content-center align-middle">
                                <div class="col-md-12 text-center">
                                    <a href="{{ route('profile.index') }}" class="btn btn-success">Edit Profil</a>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-6 text-end">
                                            <a href="{{ route('index') }}" class="btn btn-success">Tambah Data</a>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <a href="{{ route('profile.lihat-sertifikat') }}" class="btn btn-success">Sertifikat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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