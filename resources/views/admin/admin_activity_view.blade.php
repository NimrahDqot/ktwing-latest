@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ SOCIAL_MEDIA_ITEMS }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin_activity_create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ SERIAL }}</th>
                        <th>Title</th>
                        <th>Video</th>
                        <th>Thumbnail Image</th>
                        <th>{{ ACTION }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($social_media as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->video_url }}</td>
                            <td>{{ $row->thumbnail_url }}</td>
                            <td>
                                <a href="{{ route('admin_activity_edit',$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin_activity_delete',$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ ARE_YOU_SURE }}');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
