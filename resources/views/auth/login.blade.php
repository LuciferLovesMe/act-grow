@extends('layouts.template')

<style>
    body,html{
    height:100%;
}
</style>

@section('content')
    <div class="inner-page">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-8" style="background-image: url('{{ asset('assets/img/background_login.png') }}'); background-repeat: no-repeat, no-repeat;">
                    <h3><b>Masuk atau Daftar</b></h3>
                    <p><b>Dapatkan informasi terbaru seputar pasar Indonesia, standar internasional, dan transaksi pribadi dalam satu akun. Pantau kebutuhan anda dengan lebih mudah bersama ACTGROW</b></p>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('login') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" placeholder="Username" class="form-control" required autocomplete="username" name="username">
                        <div class="input-group mt-2">
                            <input type="password" name="password" class="form-control " placeholder="Password" id="password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
    
                        <div class="d-flex justify-content-around mt-2">
                            <button class="btn btn-success" type="submit">Login</button>
                            <a href="{{ route('register') }}"><button class="btn btn-outline-secondary">Daftar</button></a>
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