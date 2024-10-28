@extends('admin.app_admin')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">{{$volunteer}} Participant</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-inline-flex align-items-center gap-3">
                <h6 class="m-0 mr-3 font-weight-bold text-primary">Participant</h6>
                <span class="font-weight-bold text-success p-2 border rounded border-success"  >Total Participant: {{ $users->total() }}</span>
            </div>
            <div class="float-right d-inline">
                <a href="{{ route('admin_volunteer_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i>  Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ SERIAL }}</th>
                        <th>Image</th>
                        <th>User Detail</th>
                        <th>Other Details</th>
                        <th>Status</th>
                        <th>{{ ACTION }}</th>
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
                                    <b> user id: </b>
                                    {{ $row->id }} <br>
                                    <b>name: </b>
                                    {{$row->name}} <br>
                                    <b>Phone: </b>
                                    {{$row->phone}}
                                </p>

                            </td>
                            <td>
                                <b>Email:</b>
                                {{$row->email}} <br>
                               <b>DOB:</b>
                               {{$row->dob}} <br>
                               <b>gender:</b>
                               {{$row->gender}}
                            </td>

                            <td>

                                @if ($row->status == '0')
                                    <!-- Pending -->
                                    <button class="btn btn-success"
                                        onclick="changeStatus({{ $row->id }}, '1')">Approve</button>
                                    <button class="btn btn-danger"
                                        onclick="toggleRejectInput({{ $row->id }})">Reject</button>
                                    <div id="rejection_div_{{ $row->id }}" style="display: none;">
                                        <input type="text" id="rejection_reason_{{ $row->id }}"
                                            class="form-control mt-2" placeholder="Enter rejection reason">
                                        <button type="button" class="btn btn-danger mt-2"
                                            onclick="submitRejection({{ $row->id }})">Submit Reason</button>
                                    </div>
                                @elseif ($row->status == '1')
                                    <!-- Pending -->
                                    <button class="btn btn-warning"
                                        onclick="changeStatus({{ $row->id }}, '0')">Pending</button>
                                    <button class="btn btn-danger"
                                        onclick="toggleRejectInput({{ $row->id }})">Reject</button>
                                    <div id="rejection_div_{{ $row->id }}" style="display: none;">
                                        <input type="text" id="rejection_reason_{{ $row->id }}"
                                            class="form-control mt-2" placeholder="Enter rejection reason">
                                        <button type="button" class="btn btn-danger mt-2"
                                            onclick="submitRejection({{ $row->id }})">Submit Reason</button>
                                    </div>
                                @elseif ($row->status == '2')
                                    <!-- Rejected -->
                                    <button class="btn btn-success"
                                        onclick="changeStatus({{ $row->id }}, '1')">Approve</button>

                                    <button class="btn btn-warning"
                                        onclick="changeStatus({{ $row->id }}, '0')">Pending</button>
                                    <div>
                                        <input type="text" id="rejection_reason_{{ $row->id }}"
                                            class="form-control mt-2" placeholder="Enter rejection reason"
                                            value="{{ old('rejection_reason', $row->rejection_reason) }}" readonly>
                                    </div>
                                @endif
                            </td>

                            <td>
                            @if($row->referral_count >0)
                                 <a href="{{ route('user_refer_user',$row->id) }}" class="btn btn-info btn-sm mt-2">Refer Users</a>
                            @endif
                                <a href="{{ route('admin_user_delete',$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ ARE_YOU_SURE }}');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
   function changeStatus(id, status) {
            $.ajax({
                url: '{{route('change_user_status')}}',
                method: 'POST',
                data: {
                    id: id,
                    status: status,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    toastr.success('Status changed successfully');
                    location.reload(); // Optional: Reload page or update UI
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    toastr.success('Error occurred while changing status');
                }
            });
        }


    function toggleRejectInput(id) {
            const rejectionDiv = document.getElementById(`rejection_div_${id}`);
            rejectionDiv.style.display = rejectionDiv.style.display === 'none' ? 'block' : 'none';
        }

        function submitRejection(id) {
            const rejectionReason = document.getElementById(`rejection_reason_${id}`).value;

            if (rejectionReason.trim() === '') {
                toastr.error('Please enter a rejection reason');
                return;
            }

            $.ajax({
                url: '{{ route('submit_rejection_reason_user') }}',
                method: 'POST',
                data: {
                    id: id,
                    rejection_reason: rejectionReason,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success('Rejection reason submitted successfully');
                    location.reload(); // Reload page or handle rejection dynamically
                },
                error: function(xhr) {
                    // Check if the error response contains validation errors
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // Extract the rejection reason error messages
                        const errorMessages = xhr.responseJSON.errors.rejection_reason;

                        // Print the error messages using toastr
                        if (errorMessages && errorMessages.length) {
                            errorMessages.forEach(message => {
                                toastr.error(message);
                            });
                        } else {
                            toastr.error('Error occurred while submitting rejection reason');
                        }
                    } else {
                        toastr.error('Error occurred while submitting rejection reason');
                    }
                }
            });
        }

</script>
