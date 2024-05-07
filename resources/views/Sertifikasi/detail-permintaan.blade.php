@extends('layouts.template')

@section('modal')
    @include('Sertifikasi.modal.upload-sertifikat')
@endsection

@section('content')
    <div class="inner-page">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <h3><b>Daftar Permintaan Sertifikasi</b></h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="col-md-12 mb-3">
                                    Informasi Permintaan Sertifikasi
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" disabled value="{{ $data->nama_petani }}" class="form-control">
                                        <span class="input-group-text"><i class="@if($data->status_sertifikasi == 'menunggu verifikasi') fa fa-square @elseif($data->status_sertifikasi == 'dibatalkan') fa fa-square-xmark @elseif($data->status_sertifikasi == 'dalam proses') fa fa-square-check @else fa fa-square-xmark @endif" id="span-sign"></i></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    Kebutuhan Sertifikasi
                                </div>
                                <div class="col-auto text-center">
                                    <a href="{{ route('download-ketentuan-petani', $data->id) }}" class="btn btn-secondary mb-3">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-danger btn-batal" data-id="{{ $data->id }}" type="button">
                                        Batal
                                    </button>
                                    <button class="btn btn-success btn-terima" data-id="{{ $data->id }}" type="button">
                                        Terima
                                    </button>
                                </div>
                                <div class="col-md-12 text-center" id="button-selesaikan">
                                    <button type="button" class="btn btn-success btn-selesaikan mt-3 @if ($data->status_sertifikasi != 'dalam proses') hidden @endif" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                        Selesaikan Proses
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        });
    
        $(".btn-batal").on('click', function(){
            var id = $(this).data('id')
            $.ajax({
                url: '{{ route('ganti-status') }}',
                type: 'POST',
                data: {
                    'id': id,
                    'status': 0
                },
                success: (res) => {
                    console.log(res.message);
                    $("#span-sign").attr('class', 'fa fa-square-xmark')
                    $(".btn-selesaikan").addClass('hidden');
                }
            })
        })
    
        $(".btn-terima").on('click', function(){
            var id = $(this).data('id')
            $.ajax({
                url: '{{ route('ganti-status') }}',
                type: 'POST',
                data: {
                    'id': id,
                    'status': 1
                },
                success: (res) => {
                    console.log(res.message);
                    $("#span-sign").attr('class', 'fa fa-square-check')
                    $(".btn-selesaikan").removeClass('hidden');
                }
            })
        })
    </script>
@endpush