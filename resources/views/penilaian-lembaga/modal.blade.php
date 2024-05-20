<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('ubah-penilaian') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="" id="id-penilaian">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Penilaian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight">
                                    <div class="rate">
                                       <input type="radio" id="star-modal-5" class="rate" name="rating" value="5"/>
                                       <label for="star-modal-5" title="text">5 stars</label>
                                       <input type="radio" id="star-modal-4" class="rate" name="rating" value="4"/>
                                       <label for="star-modal-4" title="text">4 stars</label>
                                       <input type="radio" id="star-modal-3" class="rate" name="rating" value="3"/>
                                       <label for="star-modal-3" title="text">3 stars</label>
                                       <input type="radio" id="star-modal-2" class="rate" name="rating" value="2">
                                       <label for="star-modal-2" title="text">2 stars</label>
                                       <input type="radio" id="star-modal-1" class="rate" name="rating" value="1"/>
                                       <label for="star-modal-1" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea name="comment_petani" id="comment-petani" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>