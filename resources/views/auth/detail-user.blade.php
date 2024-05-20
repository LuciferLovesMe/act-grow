@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="card">
                <div class="card-header">Informasi Pengguna</div>
                <form action="{{ route('update-verif-lembaga') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_lembaga" value="{{ $data->id }}">
                    <div class="card-body">
                        <div id="row-form" class="row">
                            <div class="col-md-6 mt-2">
                                <input type="text" name="name" class="form-control" placeholder="Nama Lembaga" value="{{$data->nama_lembaga}}" required disabled>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun Berdiri" value="{{$data->tahun_berdiri}}" required disabled>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="input-group">
                                    <a href="{{ route('download-bukti-verif-lembaga', $data->id) }}" class="input-group-text" for="inputGroupFile01"><i class="fa fa-file-arrow-down"></i></a>
                                    <input type="text" name="bukti_akreditasi" class="form-control" placeholder="Bukti Akreditasi" required disabled>
                                    <div class="input-group-text">
                                      <input class="form-check-input mt-0" type="checkbox" value="1" name="verif" aria-label="Checkbox for following text input" @checked($data->status_verifikasi)>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{$data->alamat_lembaga}}" required disabled>
                            </div>
                            <div class="col-md-6 mt-2">
                                <textarea name="deskripsi" id="" class="form-control" placeholder="Deskripsi Lembaga">{{$data->deskripsi_lembaga}}</textarea>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="input-group">
                                    <label class="input-group-text" for="foto">Foto</label>
                                    <input type="file" name="foto" class="form-control" placeholder="foto" required disabled>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input type="text" name="username" class="form-control" placeholder="Username" required disabled value="{{$data->username}}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="email" name="email" class="form-control" placeholder="Email" required disabled value="{{$data->email}}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <input type="number" name="no_hp" class="form-control" placeholder="No. HP" required disabled value="{{$data->no_hp_lembaga}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('detail-lembaga') }}?id={{ $data->id }}">
                            <button type="button" class="btn btn-danger">Batal</button>
                        </a>
                        <button class="btn btn-success" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection