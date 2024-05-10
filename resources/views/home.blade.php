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
                <div class="col-md-12">
                    <div class="list-group">
                        @forelse ($data as $item)
                            <a href="{{ route('detail-lembaga') }}?id={{ $item->id }}" class="list-group-item list-group-item-action mt-3 border" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $item->nama_lembaga }}</h5>
                                    {{-- <small>3 days ago</small> --}}
                                </div>
                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                <small>And some small print.</small>
                            </a>
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
            </div>
        </div>
    </section>
@endsection

@push('custom-script')
    
@endpush