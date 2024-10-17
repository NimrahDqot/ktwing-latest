
@extends('admin.app_admin')
@section('admin_content')
<style>

</style>
    <h1 class="h3 mb-3 text-gray-800">Add District</h1>

    <form action="{{ route('admin_district_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_district_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text"  name="name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '');"  class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Code</label>
                            <input type="text" name="code" class="form-control" oninput="this.value = this.value.replace(/\s/g, '');" value="{{ old('code') }}">
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
            </div>

        </div>
    </form>
@endsection
