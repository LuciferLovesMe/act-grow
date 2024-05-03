@extends('layouts.template')

<style>
    input[type=file]{
        color:transparent;
    }
</style>

@section('content')
    <section class="inner-page">
        <div class="container">
            <form action="{{ route('sertifikasi-lembaga.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" id="parent-card">
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <input type="text" class="form-control" name="nama_sertifikat" placeholder="Nama Sertifikat" value="{{ $data->sertifikasi }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="file" class="form-control" name="kebutuhan_sertifikat" placeholder="Kebutuhan Sertifikat" id="file">
                                        <label id="fileLabel">{{ $data->template_sertifikasi }}</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="masa_berlaku" placeholder="Masa Berlaku" aria-describedby="basic-addon2" min="1" value="{{ $data->masa_berlaku }}">
                                            <span class="input-group-text" id="basic-addon2">Tahun</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-md-1 text-right justify-content-end align-self-end">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('custom-script')
    <script>
        window.pressed = function(){
            var a = document.getElementById('file');
            if(a.value == "")
            {
                fileLabel.innerHTML = "Choose file";
            }
            else
            {
                var theSplit = a.value.split('\\');
                fileLabel.innerHTML = theSplit[theSplit.length-1];
            }
        };
    </script>
@endpush