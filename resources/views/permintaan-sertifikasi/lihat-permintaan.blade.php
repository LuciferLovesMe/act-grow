@extends('layouts.template')

@section('content')
    <div class="inner-page mt-3">
        <div class="container">
            <div class="row justify-content-center">
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
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    
@endpush