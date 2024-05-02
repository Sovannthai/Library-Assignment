@extends('backends.master')
@section('title','Business Setting')
@section('contents')
    <div class="card">
        <div class="card-header text-uppercase">Business Setting</div>
        <div class="card-body">
            <form action="{{ route('business_setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12">
                        <label for="">Logo</label>
                        <input name="business_logo" id="business_logo" type="file" class="dropify" data-height="100" value="{{ @$business_setting->business_logo }}" data-default-file="{{ asset('uploads/all_photo/'.@$business_setting->business_logo) }}" /><br>
                        <input type="hidden" name="business_logo" value="{{ @$business_setting->business_logo }}" id="photo-trigger">
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-success float-lg-right">Update Business Setting</button>
            </form>
        </div>
    </div>
@endsection
