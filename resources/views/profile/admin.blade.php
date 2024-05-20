@extends('layouts.template')

@section('content')
    <br>
    <br>
    <div class="inner-page">
        <div class="container">
            <div class="card">
                <div class="card-header">Informasi Pengguna</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="row-form" class="row">
                                <div class="col-md-6 mt-2">
                                    <label class="form-label" for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Petani" disabled value="{{ $data->name }}">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $data->username }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-danger" id="btn-logout">Logout</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
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