@extends('layouts.template')

@section('content')
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('sertifikasi-lembaga.create') }}" class="btn btn-primary">Tambah Sertifikat</a>
                </div>
                <div class="col-md-12">
                    @forelse ($data as $item)
                        <div class="card">{{ $item->id }}</div>
                    @empty
                        <div class="card">Tidak ada data</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection

@push('custom-script')
    
@endpush