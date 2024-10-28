@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{$volunteer}} Participant</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-inline-flex align-items-center gap-3">
                <h6 class="m-0 mr-3 font-weight-bold text-primary">Participant</h6>
                <span class="font-weight-bold text-success p-2 border rounded border-success"  >Total Participant: {{ $visitors->total() }}</span>
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
                        <th>Visitor</th>
                        <th>Other Details</th>
                        <th>Review</th>
                        <th>Audio</th>
                        <th>Status</th>
                        <th>{{ ACTION }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($visitors as $row)
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
                                <p>
                                <b> user id: </b>
                                {{ $row->id }} <br>
                                 <b>name: </b>
                                 {{$row->name}} <br>
                                 <b>Phone: </b>
                                 {{$row->phone}}
                                </p>
                            </td>
                            <td class="text-capitalize"> <b> Role:</b>
                                {{ $row->role }} <br>
                                <b> Bio:</b>
                                {{ $row->bio }} <br>
                                <b> Grade:</b>
                                {{ $row->grade }}
                            </td>
                            <td class="text-capitalize" width="20%">
                                <span class="review-text">{{ Str::limit($row->review, 20) }}</span> <!-- Limiting to 50 characters -->

                                @if (Str::length($row->review) > 20) <!-- Check if the review is longer than 50 characters -->
                                    <a href="#collapseReview{{ $row->id }}" class="btn btn-link" data-toggle="collapse">View More</a>
                                @endif

                                <!-- Hidden full review section -->
                                <div id="collapseReview{{ $row->id }}" class="collapse">
                                    <p>{{ $row->review }}</p>
                                    <a href="#collapseReview{{ $row->id }}" class="btn btn-link" data-toggle="collapse">View Less</a>
                                </div>
                            </td>
                            <td>
                                @if($row->audio)
                                <audio controls>
                                    <source src="{{ asset('uploads/visitor/' . $row->audio) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                @endif
                            <td>
                                @if ($row->status == '1')
                                <a href="" onclick="changeStatus({{ $row->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Pending" data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="changeStatus({{ $row->id }})"><input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Pending" data-onstyle="success" data-offstyle="danger"></a>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin_visitor_delete',$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ ARE_YOU_SURE }}');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$visitors->links()}}
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
