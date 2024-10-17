@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Add Module</h1>

    <form action="{{ route('admin_manage_module_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_manage_module_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Key *</label>
                            <input type="text" name="key" class="form-control text-uppercase" value="{{ old('key') }}"  onkeydown="return /[a-zA-Z_]/i.test(event.key)" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ NAME }} *</label>
                            <input type="text" name="name" class="form-control text-capitalize" value="{{ old('name') }}">
                        </div>
                    </div>

            </div>
                <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
            </div>
        </div>
    </form>

@endsection
