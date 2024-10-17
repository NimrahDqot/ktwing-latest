@extends('admin.app_admin')
@section('admin_content')

    <h1 class="h3 mb-3 text-gray-800">View Task</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">Task</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin_task_create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ ADD_NEW }}</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ SERIAL }}</th>
                        <th>Role</th>
                        <th>Task</th>
                        <th>Sub Task</th>
                        <th>{{ ACTION }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($task as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td  class="text-capitalize">{{ isset($row->Role->name) ? $row->Role->name : '' }}</td>
                            <td>
                                <ul>
                                    @if(isset($row->module_id))
                                    @foreach(json_decode($row->module_id) as $moduleId)
                                    @if(isset(App\Models\Module::find($moduleId)->name) && !empty(App\Models\Module::find($moduleId)->name))
                                    <li> {{ App\Models\Module::find($moduleId)->name }}</li>
                                    @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @if(isset($row->sub_module_id))
                                        @foreach(json_decode($row->sub_module_id) as $subModuleId)
                                            @if(isset(App\Models\SubModule::find($subModuleId)->name) && !empty(App\Models\SubModule::find($subModuleId)->name))
                                                <li>{{ App\Models\SubModule::find($subModuleId)->name }}</li>
                                            @endif
                                        @endforeach
                                @endif

                                </ul>
                            <td>

                                <a href="{{ route('admin_task_edit',$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin_task_delete',$row->id) }}" class="btn btn-danger btn-sm {{ $row->role_id == Auth::user()->role_id ? 'disabled' : '' }} " onClick="return confirm('{{ ARE_YOU_SURE }}');"><i class="fas fa-trash-alt"></i></a>
                                   </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="col-12">
                    {{ $task->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
