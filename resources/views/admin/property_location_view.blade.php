@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ PROPERTY_LOCATION }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin_property_location_create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ SERIAL }}</th>
                        <th>{{ PHOTO }}</th>
                        <th>{{ NAME }}</th>
                        <th>{{ SLUG }}</th>
                        <th>{{ ACTION }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($property_location as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('uploads/property_location_photos/'.$row->property_location_photo) }}" alt="" class="w_200"></td>
                            <td>{{ $row->property_location_name }}</td>
                            <td>{{ $row->property_location_slug }}</td>
                            <td>
                                <a href="{{ route('admin_property_location_edit',$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin_property_location_delete',$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ ARE_YOU_SURE }}');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
