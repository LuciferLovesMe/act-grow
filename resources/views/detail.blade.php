@extends('layouts.template')

<style>
    .rate {
        float: left;
        /* height: 36px; */
        padding: 0 10px;
        }
        .rate:not(:checked) > input {
        position:absolute;
        display: none;
        }
        .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
        }
        .rated:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
        }
        .rate:not(:checked) > label:before {
        content: '★ ';
        }
        .rate > input:checked ~ label {
        color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
        }
        .star-rating-complete{
           color: #c59b08;
        }
        .rating-container .form-control:hover, .rating-container .form-control:focus{
        background: #fff;
        border: 1px solid #ced4da;
        }
        .rating-container textarea:focus, .rating-container input:focus {
        color: #000;
        }
        .rated {
        float: left;
        height: 46px;
        padding: 0 10px;
        }
        .rated:not(:checked) > input {
        position:absolute;
        display: none;
        }
        .rated:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ffc700;
        }
        .rated:not(:checked) > label:before {
        content: '★ ';
        }
        .rated > input:checked ~ label {
        color: #ffc700;
        }
        .rated:not(:checked) > label:hover,
        .rated:not(:checked) > label:hover ~ label {
        color: #deb217;
        }
        .rated > input:checked + label:hover,
        .rated > input:checked + label:hover ~ label,
        .rated > input:checked ~ label:hover,
        .rated > input:checked ~ label:hover ~ label,
        .rated > label:hover ~ input:checked ~ label {
        color: #c59b08;
        }
</style>
@section('content')
    <div class="inner-page">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-8">
                    <h4><b>{{ $data->nama_lembaga }}</b> @if($data->status_verifikasi)<span><i class="fa fa-circle-check"></i></span>@endif</h4>
                    <hr style="">
                    <h6><span><i class="fa fa-map-location-dot"></i></span> {{ $data->alamat_lembaga }}</h6><br>
                    <h6><span><i class="fa-solid fa-phone"></i></span> {{ $data->no_hp_lembaga }}</h6><br>
                    <h6><span><i class="fa-solid fa-paperclip"></i></span> {{ $data->email }}</h6><br>
                    <h5>Started In {{ $data->tahun_berdiri }}</h5>
                </div>
                <div class="col-md-4 text-center">
                    <img src="" alt="" width="100%">
                </div>
            </div>
        </div>
        <div class="" style="background-color: #f3f3f3">
            <div class="container mt-3">
                <div class="row mt-3">
                    <div class="col-md-8 mt-3">
                        <h4><b>Informasi Tambahan</b></h4>
                        <hr>
                        <p>{{ $data->deskripsi_lembaga }}</p>

                        <h4 class="mt-3"><b>Review Lembaga</b></h4>
                        <hr>
                        <ul class="list-group list-group-flush">
                            @forelse ($dataReview as $item)
                                <li class="list-group-item">
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <p class="font-weight-bold m-0"><b>{{ $item->nama_petani }}</b></p>
                                                            <div class="rated">
                                                            @for($i=1; $i<=$item->nilai; $i++)
                                                                {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating" item="5"/> --}}
                                                                <label class="star-rating-complete" title="text">{{$i}} stars</label>
                                                            @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <p>{{ $item->komentar_petani }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <a class="" data-bs-toggle="collapse" href="#collapseExample-{{ $item->id }}" role="button" aria-expanded="false" aria-controls="collapseExample-{{ $item->id }}">
                                                                Selengkapnya
                                                            </a>
                                                        </div>
                                                        <div class="col-md-12 mx-3 mt-2 collapse" id="collapseExample-{{ $item->id }}">
                                                            @if ($item->komentar_lembaga != null)
                                                                <div class="form-group row">
                                                                    <div class="col">
                                                                        <p class="font-weight-bold "><b>{{ $item->nama_lembaga }}</b></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col">
                                                                        <p>{{ $item->komentar_petani }}</p>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="form-group row">
                                                                    <div class="col">
                                                                        <p>Tidak Ada Komentar</p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item text-center">
                                    Tidak Ada Komentar.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-md-4 mt-3">
                        <h4><b>Layanan yang disediakan</b></h4>
                        <hr>
                        @forelse ($dataSertifikasi as $item)
                            <ul>
                                <li><a href="{{ route('permintaan-sertifikasi.create') }}?id={{ $item->id }}">{{ $item->sertifikasi }}</a></li>
                            </ul>
                        @empty
                            <ul>
                                <li>Tidak Ada Sertifikat Tersedia.</li>
                            </ul>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush