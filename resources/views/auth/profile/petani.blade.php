@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="card">
                <div class="card-header">Informasi Pengguna</div>
                <form action="{{ route('profile.post-petani', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div id="row-form" class="row">
                            <div class="col-md-6 mt-2">
                                <input type="text" name="name" class="form-control" placeholder="Nama Petani" required value="{{ $data->nama_petani }}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <select name="jenis_petani" id="" class="form-control" required>
                                    <option value="">-- Jenis Petani --</option>
                                    <option @selected($data->jenis_petani == 'individu') value="individu">Individu</option>
                                    <option @selected($data->jenis_petani == 'kelompok tani') value="kelompok tani">Kelompok Tani</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="{{ $data->no_hp_petani }}" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $data->alamat_petani }}" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $data->username }}" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password (Opsional jika ingin mengubah password)" id="password" autocomplete="new-password" >
                                    <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="input-group">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password (Opsional jika ingin mengubah password)" id="confirm-password" autocomplete="new-password" >
                                    <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
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
    </script>
@endpush