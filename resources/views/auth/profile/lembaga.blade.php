@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="card">
                <div class="card-header">Informasi Pengguna</div>
                <form action="{{ route('profile.post-lembaga', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div id="row-form" class="row">
                            <div class="col-md-6 mt-2">
                                <input type="text" name="name" class="form-control" placeholder="Nama Lembaga" value="{{$data->nama_lembaga}}" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun Berdiri" value="{{$data->tahun_berdiri}}" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="input-group">
                                    <a href="{{ route('download-bukti-verif-lembaga', $data->id) }}" class="input-group-text" for="inputGroupFile01"><i class="fa fa-file-arrow-down"></i></a>
                                    <input type="file" name="bukti_akreditasi" class="form-control" placeholder="Bukti Akreditasi">
                                    <div class="input-group-text">
                                      <input class="form-check-input mt-0" type="checkbox" value="1" name="verif" aria-label="Checkbox for following text input" @checked($data->status_verifikasi)>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{$data->alamat_lembaga}}" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <textarea name="deskripsi" id="" class="form-control" placeholder="Deskripsi Lembaga">{{$data->deskripsi_lembaga}}</textarea>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="input-group">
                                    <label class="input-group-text" for="foto">Foto</label>
                                    <input type="file" name="foto" class="form-control" placeholder="foto">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input type="text" name="username" class="form-control" placeholder="Username" required value="{{$data->username}}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="email" name="email" class="form-control" placeholder="Email" required value="{{$data->email}}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="number" name="no_hp" class="form-control" placeholder="No. HP" required value="{{$data->no_hp_lembaga}}">
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