@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    @if (auth()->check())
                        @if (auth()->user()->role == 'Admin')
                            <a href="{{ route('artikel.create') }}">
                                <button class="btn btn-success">Tambahkan Artikel</button>
                            </a>
                            <a href="{{ route('list-report-artikel') }}">
                                <button class="btn btn-danger">Report</button>
                            </a>
                        @endif
                    @endif
                </div>
                @forelse ($data as $item)
                    <div class="col-md-4">
                        <a href="{{ route('artikel.show', $item->id) }}">
                            <div class="card">
                                <img src="{{ asset('/upload/' . $item->cover) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">{{ $item->judul }}</h5>
                                  <p class="card-text">{{ date('d F Y', strtotime($item->tanggal_artikel)) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                            <h5 class="card-title">Tidak ada artikel tersedia.</h5>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection