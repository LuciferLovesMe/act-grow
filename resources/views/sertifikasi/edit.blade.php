@extends('layouts.template')

<style>
    span.filename {
        position: absolute;
        top: 40px;
        left: 139px;
        background: white;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        cursor: pointer;
    }

    .file-wrapper span.filename {
        top: 10px;
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
                                    <div class="col-md-4 form-group custom-file">
                                        <div class="input-group">
                                            <label class="btn btn-outline-secondary" for="file" type="button" id="button-addon1">Upload</label>
                                            @php
                                                $showFile = '';
                                                if ($data->template_sertifikasi) {
                                                    $fileName = explode('/', $data->template_sertifikasi);
                                                    $showFile = end($fileName);
                                                }
                                            @endphp
                                            <input type="text" title="{{ $showFile }}" class="form-control custom-file-label" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled value="{{ $showFile }}">
                                        </div>
                                        {{-- <label for="file" class="custom-file-upload">
                                            {{ $data->template_sertifikasi }}
                                        </label> --}}
                                        <input type="file" class="form-control" name="kebutuhan_sertifikat" placeholder="Kebutuhan Sertifikat" id="file" style="display: none;">
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
                    <div class="col-md-2 text-right justify-content-end align-self-end">
                        <a href="{{ route('show-detail-sertifikasi', $data->id) }}">
                            <button type="button" class="btn btn-success">Batal</button>
                        </a>
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('custom-script')
    <script>
        $('#file').change(function() {
            // var i = $(this).prev('label').clone();
            // var file = $('#file')[0].files[0].name;
            // $(this).prev('label').text(file);

            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

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