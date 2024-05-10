@extends('layouts.template')

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
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Penjelasan Sertifikasi Organik</h2>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            Indonesia, melalui Badan Standardisasi Nasional, telah menerbitkan standar yang dapat dijadikan acuan
                            penerapan sistem pengolahan secara organik (SNI 6729:2016 Sistem Pertanian Organik). Standar ini mengacu
                            kepada banyak standar. PT Actgrow (SICS) merupakan salah satu lembaga sertifikasi pertama di Indonesia yang memiliki pengalaman yang terbaik dan juga simple.
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h4><b>Lembaga yang Bekerja Sama dengan PT. ACTGROW</b></h4>
                            <hr>
                        </div>
                        @forelse ($data as $item)
                            <div class="col-md-6 p-2">
                                <a href="{{ route('detail-lembaga') }}?id={{ $item->id }}">
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="{{ asset('upload/' . $item->foto_lembaga) }}" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $item->nama_lembaga }}</h5>
                                                    <hr>
                                                    <h6 class="card-text ms-auto"><i class="fa fa-star" style="color: #ffc700;"></i> {{ $item->nilai }} <i class="fa fa-comment"></i> {{ $item->komen }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <a href="#" class="list-group-item list-group-item-action mt-3" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Tidak ada data tersedia</h5>
                                    {{-- <small>3 days ago</small> --}}
                                </div>
                                {{-- <p class="mb-1">Some placeholder content in a paragraph.</p> --}}
                                {{-- <small>And some small print.</small> --}}
                            </a>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <h4><b>Produk Sertifikasi PT ACTGROW</b></h4>
                    <hr>
                        @forelse ($listLayanan as $item)
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
                    <br>
                    <h4 class="mt-3"><b>Informasi Tambahan</b></h4>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('assets/img/informasi_tambahan.png') }}" alt="">
                            </div>
                            <br>
                            <div class="col-md-12 text-center">
                                <p>Sertifikasi Produk Organik</p>
                            </div>
                            <div class="col-md-12 text-center">
                                <a href="{{ asset('assets/img/informasi_tambahan.png') }}" download="" class="btn btn-success">Download Brosur</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('custom-script')
    
@endpush