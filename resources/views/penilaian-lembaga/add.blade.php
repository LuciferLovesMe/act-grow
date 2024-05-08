@extends('layouts.template')

<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
        }
        .rate:not(:checked) > input {
        position:absolute;
        display: none;
        }
        .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
        }
        .rated:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
        }
        .rate:not(:checked) > label:before {
        content: '★ ';
        }
        .rate > input:checked ~ label {
        color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
        }
        .star-rating-complete{
           color: #c59b08;
        }
        .rating-container .form-control:hover, .rating-container .form-control:focus{
        background: #fff;
        border: 1px solid #ced4da;
        }
        .rating-container textarea:focus, .rating-container input:focus {
        color: #000;
        }
        .rated {
        float: left;
        height: 46px;
        padding: 0 10px;
        }
        .rated:not(:checked) > input {
        position:absolute;
        display: none;
        }
        .rated:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ffc700;
        }
        .rated:not(:checked) > label:before {
        content: '★ ';
        }
        .rated > input:checked ~ label {
        color: #ffc700;
        }
        .rated:not(:checked) > label:hover,
        .rated:not(:checked) > label:hover ~ label {
        color: #deb217;
        }
        .rated > input:checked + label:hover,
        .rated > input:checked + label:hover ~ label,
        .rated > input:checked ~ label:hover,
        .rated > input:checked ~ label:hover ~ label,
        .rated > label:hover ~ input:checked ~ label {
        color: #c59b08;
        }
</style>
@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight">
                                    <b>Nama</b>
                                </div>
                                <div class="p-2 bd-highlight">
                                    <div class="rate">
                                       <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                       <label for="star5" title="text">5 stars</label>
                                       <input type="radio" id="star4" class="rate" name="rating" value="4"/>
                                       <label for="star4" title="text">4 stars</label>
                                       <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                       <label for="star3" title="text">3 stars</label>
                                       <input type="radio" id="star2" class="rate" name="rating" value="2">
                                       <label for="star2" title="text">2 stars</label>
                                       <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                       <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                                <div class="ms-auto p-2 bd-highlight">
                                    <button type="button" class="btn"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea name="comment_petani" id="comment-petani" class="form-control"></textarea>
                        </div>
                        <div class="card-footer text-right align-items-right">
                            <button class="btn btn-secondary mr-3">Batal</button>
                            <button class="btn btn-success ml-3">Simpan</button>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
@endsection