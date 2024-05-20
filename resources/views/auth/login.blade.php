@extends('layouts.template')

<style>
    body,html{
    height:100%;
}
</style>

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-md-8 align-items-center min-vh-100" style="background-image: url('{{ asset('assets/img/background_login.png') }}'); background-size: cover; background-position: center;">
                    <div class="d-flex flex-column justify-content-center">
                        {{-- <h3 class=""><b>Masuk atau Daftar</b></h3>
                        <p class="d-flex flex-column justify-content-center"><b>Dapatkan informasi terbaru seputar pasar Indonesia, standar internasional, dan transaksi pribadi dalam satu akun. Pantau kebutuhan anda dengan lebih mudah bersama ACTGROW</b></p> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('login') }}" method="post" id="form" enctype="multipart/form-data">
                        @csrf
                        <input type="text" placeholder="Username" class="form-control @error('username') is-invalid @enderror" autocomplete="username" name="username" id="username">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="input-group mt-2">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" autocomplete="new-password">
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <button class="btn btn-success w-100" type="button" id="btn-login">Login</button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('register') }}"><button class="btn btn-outline-secondary w-100" type="button">Daftar</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        $( '.btn-password').on('click', function() {
            if($(this).children('i').hasClass('fa-eye-slash')) {
                $(this).children('i').removeClass('fa-eye-slash')
                $(this).children('i').addClass('fa-eye')
                $(this).parent().children('input').attr('type', 'password')
            } else {
                $(this).children('i').removeClass('fa-eye')
                $(this).children('i').addClass('fa-eye-slash')
                $(this).parent().children('input').attr('type', 'text')
            }
        })

        $("#btn-login").on('click', function (e) {
            e.preventDefault()
            var pass = $("#password").val()
            var username = $("#username").val()
            if(pass.length < 1 || username.length < 1 ){
                Swal.fire({
                    title: "Terjadi kesalahan!",
                    text: "Semua data wajib diisi.",
                    icon: "error"
                });
            } else {
                $("#form").submit()
            }
        })
    </script>
@endpush