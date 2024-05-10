@extends('layouts.template')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Judul Artikel</th>
                                <th class="text-center">Saran</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->judul }}</td>
                                    <td class="text-center">{{ $item->saran_artikel }}</td>
                                    <td class="text-center">
                                        @if ($item->status)
                                            <i class="fa fa-square-check"></i>
                                        @else
                                            <i class="fa fa-square"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (!$item->status)
                                            <button class="btn btn-success btn-konfirm" type="button" data-id="{{ $item->id }}">Konfirmasi</button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @if (!$item->status)
                                    <form action="{{ route('confirm-report') }}" method="post" enctype="multipart/form-data" id="confirm-{{ $item->id }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                    </form>
                                @else
                                    -
                                @endif
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
    <script>
        $(".btn-konfirm").on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: "Konfirmasi Report",
                text: "Apakah Anda Yakin Ingin Mengkonfirmasi?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#confirm-${id}`).submit()
                }
            });
        })
    </script>
@endpush