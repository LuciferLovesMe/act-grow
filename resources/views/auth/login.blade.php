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
                    <form action="{{ route('login') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" placeholder="Username" class="form-control" required autocomplete="username" name="username">
                        <div class="input-group mt-2">
                            <input type="password" name="password" class="form-control " placeholder="Password" id="password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
    
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <button class="btn btn-success w-100" type="submit">Login</button>
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
    </script>
@endpush