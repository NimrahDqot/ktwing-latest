@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ ADD_SOCIAL_MEDIA_ITEM }}</h1>

    <form action="{{ route('admin_activity_store') }}" method="post" enctype="multipart/form-data" >
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_activity_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ VIEW_ALL }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ TITLE }} *</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ URL }} *</label>
                            <input type="text" name="video_url" class="form-control" value="{{ old('video_url') }}" autofocus>
                        </div>
                    </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" accept="image/*" onchange="loadFile(event)" name="thumbnail_url"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img id="output" class="w_150" style="cursor: pointer;" onclick="zoomImage(this)" />
                        </div>
                        <div id="modal" class="modal modal-image" onclick="closeModal()">
                            <span class="close close-image" onclick="closeModal()">&times;</span>
                            <img class="modal-image-content modal-content" id="modalImage">
                            <div id="caption"></div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
            </div>
        </div>
    </form>

@endsection
