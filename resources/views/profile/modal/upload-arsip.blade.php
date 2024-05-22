<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('profile.upload-arsip') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Arsip Sertifikat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label for="id_template_sertifikasi" class="form-label">Sertifikat</label>
                                    <select name="id_template_sertifikasi" class="select2 form-control" id="id_template_sertifikasi">
                                        <option value="">-- Pilih Sertifikat --</option>
                                        @foreach ($dataSertifikat as $item)
                                            <option value="{{ $item->id }}">{{ $item->sertifikasi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="text" name="tahun" class="form-control">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="exampleFormControlInput1" class="form-label">File Sertifikat</label>
                                    <input type="file" class="form-control" name="file_arsip" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </form>
    </div>
</div>