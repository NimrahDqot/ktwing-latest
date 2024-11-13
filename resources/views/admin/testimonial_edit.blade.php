@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ EDIT_TESTIMONIAL }}</h1>

    <form action="{{ route('admin_testimonial_update',$testimonial->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="current_photo" value="{{ $testimonial->photo }}">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_testimonial_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ VIEW_ALL }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">{{ NAME }} *</label>
                    <input type="text" name="name" class="form-control" value="{{ $testimonial->name }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">{{ DESIGNATION }} *</label>
                    <input type="text" name="designation" class="form-control" value="{{ $testimonial->designation }}">
                </div>
                <div class="form-group">
                    <label for="">{{ CONTENT }} *</label>
                    <textarea name="description" class="form-control h_100" cols="30" rows="10">{{ $testimonial->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">{{ EXISTING_PHOTO }}</label>
                    <div>
                        <img src="{{ $testimonial->image }}" alt="" class="w_100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">{{ CHANGE_PHOTO }}</label>
                    <div>
                        <input type="file" name="image">
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-success">{{ UPDATE }}</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.project_end_date').forEach(function(element) {
                element.addEventListener('click', function() {

                    document.querySelectorAll('.date_disable').forEach(function(el) {
                        if (el.disabled) {
                            el.disabled = false; // Enable the element
                        } else {
                            el.disabled = true; // Disable the element
                        }
                    });
                });
            });
        });

        </script>
@endsection
