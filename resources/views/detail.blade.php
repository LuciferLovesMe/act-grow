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

@section('modal')
    @include('penilaian-lembaga.modal')
    @include('penilaian-lembaga.modal-lembaga')
@endsection

@section('hero')
    <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        {{-- <h1>Welcome to <span>BizLand</span></h1>
        <h2>We are team of talented designers making websites with Bootstrap</h2>
        <div class="d-flex">
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div> --}}
    </div>
    </section>
@endsection

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
                    <div class="form-group row">
                        <div class="col-md-12">
                            <img src="{{ asset('/upload/' . $data->foto_lembaga) }}" alt="" width="50%">
                        </div>
                        <div class="col-md-12 text-center mt-2">
                            @if (auth()->check())
                                @if (auth()->user()->role == 'Petani')
                                    <a href="{{ route('lihat-permintaaan') }}?idLembaga={{$data->id}}" class="btn btn-success">Permintaan Sertifikasi</a>
                                @elseif (auth()->user()->role == 'Lembaga')
                                    <a href="{{ route('profile.index') }}" class="btn btn-success">Profil</a>
                                    <a href="{{ route('sertifikasi-lembaga.create') }}" class="btn btn-success">Tambah Sertifikasi</a>
                                @else
                                    <a href="{{ route('profil-lembaga', $data->id) }}" class="btn btn-success">Edit</a>
                                    <a href="{{ route('lihat-permintaaan') }}?idLembaga={{$data->id}}" class="btn btn-success">Permintaan Sertifikasi</a>
                                @endif
                            @endif
                        </div>
                    </div>
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
                            @if (auth()->check())
                                @if (auth()->user()->role == 'Petani')
                                    @php
                                        $cekData = DB::table('penilaian')
                                            ->where('id_lembaga', $data->id)
                                            ->where('u.id', auth()->user()->id)
                                            ->join('petani', 'petani.id', 'penilaian.id_petani')
                                            ->join('users as u', 'u.id', 'petani.id_user')
                                            ->select(
                                                'penilaian.*',
                                                'petani.nama_petani',
                                                'u.id as user_id_petani'
                                            )
                                            ->get();
                                    @endphp
                                    @if (count($cekData) < 1)
                                        <div class="list-group-item rounded">
                                            <form action="{{ route('post-penilaian') }}" method="post" enctype="multipart/form-data" id="form-komentar">
                                                @csrf
                                                <input type="hidden" name="id_petani" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="id_lembaga" value="{{ $data->id }}">
                                                <div class="card border-0">
                                                    <div class="card-header">
                                                        <div class="d-flex bd-highlight">
                                                            <div class="p-2 bd-highlight">
                                                                <div class="rate">
                                                                <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio" id="star4" class="rate" name="rating" value="4"/>
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                                                <label for="star1" title="text">1 star</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <textarea name="comment_petani" id="komentar-petani" placeholder="Komentar" class="form-control"></textarea>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <button class="btn btn-danger" id="btn-batal" type="button">Batal</button>
                                                        <button class="btn btn-success ml-3" type="submit">Kirim</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            @forelse ($dataReview as $item)
                                <li class="list-group-item rounded mt-3">
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
                                                        @if (auth()->check())
                                                            @if (auth()->user()->id == $item->user_id_petani)
                                                                <div class="col text-right d-flex justify-content-end">
                                                                    <div class="dropdown">
                                                                        <button class="border-0" style="background-color: #fff" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <i class="fa fa-ellipsis-vertical"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" id="ubah-komentar" data-id="{{ $item->id }}" data-komentar="{{ $item->komentar_petani }}" data-rating="{{ $item->nilai }}" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Ubah</a></li>
                                                                            <li><a class="dropdown-item" id="hapus-komentar" href="#">Hapus</a></li>
                                                                        </ul>
                                                                      </div>
                                                                </div>

                                                                <form action="{{ route('hapus-penilaian', $item->id) }}" method="POST" enctype="multipart/form-data" id="form-hapus">
                                                                    @csrf
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <p>{{ $item->komentar_petani }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <a class="" data-bs-toggle="collapse" href="#collapseExample-{{ $item->id }}" role="button" aria-expanded="false" aria-controls="collapseExample-{{ $item->id }}">
                                                                Lihat Selengkapnya
                                                            </a>
                                                        </div>
                                                        <div class="col-md-12 mx-3 mt-2 collapse" id="collapseExample-{{ $item->id }}">
                                                            @if ($item->komentar_lembaga != null)
                                                                @if (auth()->check())
                                                                    @if (auth()->user()->role == 'Lembaga' && $item?->user_id_lembaga == auth()->user()->id)
                                                                        <div class="form-group row">
                                                                            <div class="col">
                                                                                <p class="font-weight-bold "><b>{{ $data->nama_lembaga }}</b></p>
                                                                            </div>
                                                                            <div class="col">
                                                                                <button class="border-0" style="background-color: #fff" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                    <i class="fa fa-ellipsis-vertical"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" id="ubah-komentar-lembaga" data-id="{{ $item->id }}" data-komentar="{{ $item->komentar_lembaga }}" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalLembaga">Ubah</a></li>
                                                                                    <li><a class="dropdown-item" id="hapus-komentar-lembaga" href="#">Hapus</a></li>
                                                                                </ul>

                                                                                <form action="{{ route('hapus-lembaga', $item->id) }}" method="POST" enctype="multipart/form-data" id="form-hapus-lembaga">
                                                                                    @csrf
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col">
                                                                                <p>{{ $item->komentar_lembaga }}</p>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="form-group row">
                                                                            <div class="col">
                                                                                <p class="font-weight-bold "><b>{{ $data->nama_lembaga }}</b></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col">
                                                                                <p>{{ $item->komentar_lembaga }}</p>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="form-group row">
                                                                        <div class="col">
                                                                            <p class="font-weight-bold "><b>{{ $data->nama_lembaga }}</b></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col">
                                                                            <p>{{ $item->komentar_lembaga }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                @if (auth()->check())
                                                                    @if (auth()->user()->role == 'Lembaga' && $item?->user_id_lembaga == auth()->user()->id)
                                                                        <div class="form-group row">
                                                                            <form action="{{ route('post-lembaga') }}" method="post" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                                <div class="card border-0">
                                                                                    <div class="card-body">
                                                                                        <textarea name="komentar_lembaga" id="komentar_lembaga" placeholder="Komentar Lembaga" class="form-control"></textarea>
                                                                                    </div>
                                                                                    <div class="card-footer text-right align-items-right d-flex justify-content-end">
                                                                                        <button class="btn btn-success ml-3">Kirim</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="form-group row">
                                                                        <div class="col">
                                                                            <p>Tidak Ada Komentar</p>
                                                                        </div>
                                                                    </div>
                                                                @endif
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
                                <li>
                                    @if (auth()->check())
                                        @if (auth()->user()->role == 'Petani')
                                            <a href="{{ route('permintaan-sertifikasi.create') }}?id={{ $item->id }}">{{ $item->sertifikasi }}</a>
                                        @else
                                            <a href="{{ route('show-detail-sertifikasi', $item->id) }}">{{ $item->sertifikasi }}</a>
                                        @endif
                                    @else
                                        <a href="{{ route('show-detail-sertifikasi', $item->id) }}">{{ $item->sertifikasi }}</a>
                                    @endif
                                </li>
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
    <script>
        $("#hapus-komentar").on('click', function(e) {
            Swal.fire({
                title: "Konfirmasi Hapus",
                text: "Apakah Anda Yakin Ingin Menghapus Komentar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#form-hapus").submit()
                }
            });
        })

        $("#ubah-komentar").on('click', function() {
            var id = $(this).data('id')
            var komen = $(this).data('komentar')
            var rating = $(this).data('rating')
            
            $("#id-penilaian").val(id)
            $("#comment-petani").val(komen)
            $(`#star-modal-${rating}`).attr('checked', true)
        })

        $("#hapus-komentar-lembaga").on('click', function(e) {
            Swal.fire({
                title: "Konfirmasi Hapus",
                text: "Apakah Anda Yakin Ingin Menghapus Balasan?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#form-hapus-lembaga").submit()
                }
            });
        })

        $("#ubah-komentar-lembaga").on('click', function() {
            var id = $(this).data('id')
            var komen = $(this).data('komentar')
            
            $("#id-penilaian-lembaga").val(id)
            $("#comment-lembaga").val(komen)
        })

        $("#btn-batal").on('click', function () {
            $("#komentar-petani").val('');
            $("#form-komentar input[type=radio]").each(function(i, v) {
                $(this).prop('checked', false);
            })
        })
    </script>
@endpush