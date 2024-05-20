@extends('layouts.template')

@section('content')
    <div class="inner-page mt-3">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Informasi Pengguna
                </div>
                <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role1" value="Lembaga" checked>
                                    <label class="form-check-label" for="role1">
                                      Lembaga
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role2" value="Petani">
                                    <label class="form-check-label" for="role2">
                                      Petani
                                    </label>
                                </div>
                            </div>
                            <div id="row-form" class="row">
                                
                                <div class="col-md-6 mt-2">
                                    <input type="text" name="name" class="form-control" placeholder="Nama Lembaga" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun Berdiri" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="input-group">
                                        <label class="input-group-text" for="bukti_akreditasi">Bukti Akreditasi</label>
                                        <input type="file" name="bukti_akreditasi" class="form-control" placeholder="bukti_akreditasi" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <textarea name="deskripsi" id="" class="form-control" placeholder="Deskripsi Lembaga"></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="input-group">
                                        <label class="input-group-text" for="foto">Foto</label>
                                        <input type="file" name="foto" class="form-control" placeholder="foto" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="text" name="no_hp" class="form-control" placeholder="No. HP" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" id="password" autocomplete="new-password" required>
                                        <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" id="confirm-password" autocomplete="new-password" required>
                                        <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
    
                                <div class="col-md-12 mt-3">
                                    <div class="row" id="parent-card">
                                        <div class="col-md-12 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <button class="btn btn-success btn-add" type="button">+</button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4 form-group">
                                                            <input type="text" class="form-control" name="nama_sertifikat[]" placeholder="Nama Sertifikat">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <input type="file" class="form-control" name="kebutuhan_sertifikat[]" placeholder="Kebutuhan Sertifikat">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <input type="number" class="form-control" name="masa_berlaku[]" placeholder="Masa Berlaku">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right d-flex justify-content-end">
                        <button class="btn btn-outline-secondary mx-3" type="button" id="btn-batal">Batal</button>
                        <button class="btn btn-success" type="submit" id="btn-submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        var countSertifikat = 1;
        var role = null;

        $("#row-form").on('click', '.btn-add', function (){
            $("#parent-card").append(`
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-success btn-add" type="button">+</button>
                            <button class="btn btn-danger btn-remove" type="button">-</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <input type="text" class="form-control" name="nama_sertifikat[]" placeholder="Nama Sertifikat">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="file" class="form-control" name="kebutuhan_sertifikat[]" placeholder="Kebutuhan Sertifikat">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="number" class="form-control" name="masa_berlaku[]" placeholder="Masa Berlaku">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `)
            countSertifikat++
        })

        $("#row-form").on('click', '.btn-remove', function() {
            if(countSertifikat > 1) {
                $(this).parent().parent().parent().remove()
            }
        })

        $("#row-form").on('click', '.btn-password', function() {
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

        $("#btn-submit").on('click', function(e) {
            e.preventDefault();
            var pass = $("#password").val();
            var confPass = $("#confirm-password").val()
            var inputNull = []

            $.each($("#row-form input"), function(i, value) {
                console.log($(this).val());
                if($(this).val().length < 1 || $(this).val() == null || $(this).val() == ''){
                    if($(this).attr("name") == "nama_sertifikat[]" || $(this).attr("name") == "kebutuhan_sertifikat[]" || $(this).attr("name") == "masa_berlaku[]"){
                        console.log($(this));
                    } else {
                        inputNull.push($(this).attr("name"))
                    }
                }
            })
            console.log(inputNull);

            if(inputNull.length > 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Data yang anda masukkan tidak valid!",
                    });
            }

            if(confPass != pass) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Konfirmasi Password Anda Salah!",
                    });
            }
            
            if(confPass == pass && inputNull.length < 1) {
                $("#form").submit()
            }
            
                
        })

        $("input[type=radio][name=role]").change(function() {
            role = $(this).val()
            if($(this).val() == 'Lembaga') {
                $("#row-form").empty()
                $("#row-form").append(`
                    <div class="col-md-6 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="Nama Lembaga" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun Berdiri" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <label class="input-group-text" for="bukti_akreditasi">Bukti Akreditasi</label>
                            <input type="file" name="bukti_akreditasi" class="form-control" placeholder="bukti_akreditasi" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <textarea name="deskripsi" id="" class="form-control" placeholder="Deskripsi Lembaga" required></textarea>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <label class="input-group-text" for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" placeholder="foto" required>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="number" name="no_hp" class="form-control" placeholder="No. HP" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" id="confirm-password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="row" id="parent-card">
                            <div class="col-md-12 mt-3">
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-success btn-add" type="button">+</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <input type="text" class="form-control" name="nama_sertifikat[]" placeholder="Nama Sertifikat">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="file" class="form-control" name="kebutuhan_sertifikat[]" placeholder="Kebutuhan Sertifikat">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="number" class="form-control" name="masa_berlaku[]" placeholder="Masa Berlaku">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
            } else {
                $("#row-form").empty()
                $("#row-form").append(`
                    <div class="col-md-6 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="Nama Petani" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select name="jenis_petani" id="" class="form-control" required>
                            <option value="">-- Jenis Petani --</option>
                            <option value="individu">Individu</option>
                            <option value="kelompok tani">Kelompok Tani</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" name="telepon" class="form-control" placeholder="Telepon" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" id="confirm-password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                `)
            }
        })

        $("#btn-batal").on('click', function (){
            console.log(role);

            if(role == 'Lembaga') {
                $("#row-form").empty()
                $("#row-form").append(`
                    <div class="col-md-6 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="Nama Lembaga" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun Berdiri" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <label class="input-group-text" for="bukti_akreditasi">Bukti Akreditasi</label>
                            <input type="file" name="bukti_akreditasi" class="form-control" placeholder="bukti_akreditasi" required>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <textarea name="deskripsi" id="" class="form-control" placeholder="Deskripsi Lembaga" required></textarea>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <label class="input-group-text" for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" placeholder="foto" required>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="number" name="no_hp" class="form-control" placeholder="No. HP" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" id="confirm-password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="row" id="parent-card">
                            <div class="col-md-12 mt-3">
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-success btn-add" type="button">+</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <input type="text" class="form-control" name="nama_sertifikat[]" placeholder="Nama Sertifikat">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="file" class="form-control" name="kebutuhan_sertifikat[]" placeholder="Kebutuhan Sertifikat">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="number" class="form-control" name="masa_berlaku[]" placeholder="Masa Berlaku">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
            } else {
                $("#row-form").empty()
                $("#row-form").append(`
                    <div class="col-md-6 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="Nama Petani" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select name="jenis_petani" id="" class="form-control" required>
                            <option value="">-- Jenis Petani --</option>
                            <option value="individu">Individu</option>
                            <option value="kelompok tani">Kelompok Tani</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" name="telepon" class="form-control" placeholder="Telepon" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" id="confirm-password" autocomplete="new-password" required>
                            <button class="btn btn-outline-secondary btn-password" type="button" id=""><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                `)
            }
        })
    </script>
@endpush