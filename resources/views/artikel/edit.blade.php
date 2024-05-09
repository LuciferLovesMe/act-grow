@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('artikel.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Informasi Artikel
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="input-group">
                                            <label class="input-group-text" for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" required name="tanggal" placeholder="Tanggal Artikel" value="{{ $data->tanggal_artikel }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="judul" class="form-control" required placeholder="Judul Artikel" value="{{ $data->judul }}">
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="input-group">
                                            <label class="input-group-text" for="cover">Cover</label>
                                            <input type="file" name="cover" class="form-control" placeholder="cover">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <textarea name="teks_artikel" class="form-control" id="text-artikel" cols="" rows="" placeholder="Teks Artikel">{{ $data->teks_artikel }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right d-flex justify-content-end p-2">
                                <a href="{{ route('artikel.index') }}">
                                    <button class="btn btn-secondary-outline">Batal</button>
                                </a>
                                <button class="btn btn-success" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        ClassicEditor
            .create( document.querySelector( '#text-artikel' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush