@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">View Role</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
            {{-- <div class="float-right d-inline">
                <a href="{{ route('admin_role_create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ ADD_NEW }}</a>
            </div> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ SERIAL }}</th>
                        <th>{{ TITLE }}</th>
                        <th>{{ STATUS }}</th>
                        {{-- <th>{{ ACTION }}</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-capitalize">{{ $row->name }}</td>
                            <td>
                                @if(!$used_role_ids->contains($row->id))
                                    @if ($row->status == '1')
                                    <a href="" onclick="roleStatus({{ $row->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Pending" data-onstyle="success" data-offstyle="danger"></a>
                                    @else
                                        <a href="" onclick="roleStatus({{ $row->id }})"><input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Pending" data-onstyle="success" data-offstyle="danger"></a>
                                    @endif
                                @else
                                <input type="checkbox" {{ $row->status == '1' ? 'checked' : '' }} disabled data-toggle="toggle" data-on="Active" data-off="Pending" data-onstyle="success" data-offstyle="danger">

                                @endif
                            </td>
                            <td>
                                {{-- <a href="{{ route('admin_role_edit',$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                @if(!$used_role_ids->contains($row->id))
                                <a href="{{ route('admin_role_delete', $row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ ARE_YOU_SURE }}');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                @endif --}}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function roleStatus(id){
            $.ajax({
                type:"get",
                url:"{{url('/admin/role-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);
                }
            })
        }
    </script>
@endsection
