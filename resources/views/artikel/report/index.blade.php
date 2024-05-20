@extends('layouts.template')

@section('hero')
    <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <h3 style="color: white">Artikel</h3>
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
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#confirm-${id}`).submit()
                } else {
                    window.location.replace("{{ route('artikel.index') }}")
                }
            });
        })
    </script>
@endpush