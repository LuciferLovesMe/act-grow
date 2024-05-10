@extends('layouts.template')

@section('hero')
    <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <p style="color: white">Layanan</p>
        <hr style="background-color: white; color: white">
        <h3 style="color: white">{{ ucwords($data->nama_lembaga) }}</h3>
    </div>
    </section>
@endsection

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
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->nama_petani }}</td>
                                    <td class="text-center">{{ ucwords($item->status_sertifikasi) }}</td>
                                    <td class="text-center">
                                        @if ($item->status_sertifikasi == 'selesai')
                                            <a href="{{ route('download-sertifikat', $item->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Lihat Sertifikat</a>
                                        @else
                                            <a href="{{ route('detail-permintaan-sertifikasi', $item->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Detail</a>
                                        @endif
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