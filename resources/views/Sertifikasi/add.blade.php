@extends('layouts.template')

@section('content')
    <section class="inner-page">
        <div class="container">
            <form action="{{ route('sertifikasi-lembaga.store') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                <div class="row justify-content-end mt-3">
                    <div class="col-md-1 text-right justify-content-end align-self-end">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('custom-script')
    <script>
        var countSertifikat = 1;

        $("#parent-card").on('click', '.btn-add', function (){
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

        $("#parent-card").on('click', '.btn-remove', function() {
            if(countSertifikat > 1) {
                $(this).parent().parent().parent().remove()
            }
        })
    </script>
@endpush