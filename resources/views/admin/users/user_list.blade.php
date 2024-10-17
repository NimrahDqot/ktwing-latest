@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">User List</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">Users</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ SERIAL }}</th>
                        <th>User</th>
                        <th>Refer Details</th>
                        <th>Contact Details</th>
                        <th>Other Details</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($users as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-capitalize">
                                @if($row->image)
                                <img src="{{ asset($row->image) }}" style="cursor: pointer;" onclick="zoomImage(this)" class="w_50">

                                @else
                                <a href="{{ asset('uploads/user_photos/default_photo.jpg')}}" target="_blank">
                                    <img src="{{ asset('uploads/user_photos/default_photo.jpg')}}" alt="{{ $row->name }}" class="w_50">
                                </a>
                                @endif
                            </td>
                            <td class="text-capitalize">
                                    <p>
                                        @if(isset($row->Volunteer_info->name))
                                        <b>Refer Volunteer: </b>
                                        {{ isset($row->Volunteer_info->name) ? $row->Volunteer_info->name : 'no volunteer' }} <br>
                                        @endif
                                        @if(isset($row->user_info->name))
                                        @if(strlen($row->user_info->name) < 0)
                                            <?php $name = 'no user' ?>
                                        @else
                                        <?php $name = $row->user_info->name; ?>
                                        @endif
                                        <b>Refer User: </b>
                                        {{ $name}} <br>
                                        @endif

                                    </p>

                                </td>
                                <td>
                                    @if($row->name)
                                    <b>name: </b>
                                    {{ $row->name }}<br>
                                    @endif
                                    @if($row->email)
                                    <b>Email:</b>
                                    {{ $row->email }}
                                    @endif
                                    <br>
                                    @if($row->phone)
                                    <b>Phone: </b>
                                    {{ $row->phone }}<br>
                                    @endif

                                </td>

                                <td>
                                    @if($row->dob)
                                    <b>DOB:</b>
                                    {{ $row->dob }} <br>
                                    @endif
                                    @if($row->gender)
                                    <b>gender:</b>
                                    {{ $row->gender }}
                                    @endif

                                    @if($row->referral_count)
                                    <b>referral_count:</b>
                                    {{ $row->referral_count }} <br>
                                    @endif
                                    @if($row->current_level)
                                    <b>current_level:</b>
                                    {{ $row->level_info->level_name }}
                                    @endif
                                </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
                <div id="modal" class="modal modal-image" onclick="closeModal()">
                    <span class="close close-image" onclick="closeModal()">&times;</span>
                    <img class="modal-image-content modal-content" id="modalImage">
                    <div id="caption"></div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function changeStatus(id){
        $.ajax({
            type:"get",
            url:"{{url('/admin/visitor-status/')}}"+"/"+id,
            success:function(response){
               toastr.success(response)
            },
            error:function(err){
                console.log(err);
            }
        })
    }
</script>
