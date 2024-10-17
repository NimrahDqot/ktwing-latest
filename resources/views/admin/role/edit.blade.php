@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Role</h1>

    <form action="{{ route('admin_role_update',$role->id) }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_role_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ TITLE }} *</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}" autofocus>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ UPDATE }}</button>
            </div>
        </div>
    </form>

@endsection
