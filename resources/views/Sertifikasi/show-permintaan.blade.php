@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>{{ $dataSertifikasi->sertifikasi }}</h3>
                </div>
                <div class="col-md-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Petani</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($listSertifikasi as $key => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_petani }}</td>
                                    <td>{{ ucwords($item->status_sertifikasi) }}</td>
                                    <td>
                                        <a href="{{ route('detail-permintaan-sertifikasi', $item->id) }}" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4" class="text-center">Tidak ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush