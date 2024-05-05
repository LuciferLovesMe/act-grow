@extends('layouts.template')

@section('content')
    <div class="inner-page mt-3">
        <div class="container">
            {{-- <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    <h4><b>{{ $data->sertifikasi }}</b></h4>
                    <hr>
                    <h1><i class="fa fa-file"></i></h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3 text-center">
                    <p>{{ ucwords($data->status_sertifikasi) }}</p>
                    <hr>
                </div>    
            </div> --}}
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Sertifikat</th>
                                <th class="text-center">Status Sertifikasi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->sertifikasi }}</td>
                                    <td class="text-center">{{ ucwords($item->status_sertifikasi) }}</td>
                                    <td class="text-center">
                                        @if ($item->status_sertifikasi == 'selesai')
                                            <a href="{{ route('download-sertifikat', $item->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> Lihat Sertifikat</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                
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