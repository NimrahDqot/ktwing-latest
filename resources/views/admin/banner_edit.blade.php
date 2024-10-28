@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Banner</h1>

        <form action="{{ route('admin_banner_update',$banner->id) }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_banner_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                        {{ VIEW_ALL }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">{{ TITLE }} *</label>
                            <input type="text" name="title" class="form-control" value="{{ $banner->title }}" autofocus>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="type">Type *</label>
                            <select name="type" class="form-control" id="typeSelect">
                                <option value="" disabled selected>--Please select type--</option>
                                <option value="banner" {{ $banner->type == 'banner' ? 'selected' : '' }}>Banner</option>
                                <option value="logo" {{ $banner->type == 'logo' ? 'selected' : '' }}>Logo</option>
                                <option value="offer" class="offer-select" {{ $banner->type == 'offer' ? 'selected' : '' }}>Offers</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 offer-amount {{ $banner->type == 'offer' ? 'd-block' : 'd-none' }}">
                        <div class="form-group ">
                            <label for="offerAmount">Offer Amount</label>
                            <input type="number" name="offer_amount" class="form-control" value="{{ $banner->offer_amount }}">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Sort *</label>
                            <input type="number" name="sort_by" class="form-control" value="{{ $banner->sort_by }}">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)"  name="image" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <img id="output" class="w_150" style="cursor: pointer;" onclick="zoomImage(this)" src="{{ asset($banner->image )}}" />
                    </div>
                    <div id="modal" class="modal modal-image" onclick="closeModal()">
                        <span class="close close-image" onclick="closeModal()">&times;</span>
                        <img class="modal-image-content modal-content" id="modalImage">
                        <div id="caption"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ UPDATE }}</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function(){
            $('#typeSelect').change(function(){
                var selectedValue = $(this).val();
                if (selectedValue === 'offer') {
                    $('.offer-amount').removeClass('d-none').addClass('d-block');
                } else {
                    $('.offer-amount').removeClass('d-block').addClass('d-none');
                }
            });
        });
    </script>
@endsection
