@extends('admin.app_admin')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">{{$user_name}} Refer Participant</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-inline-flex align-items-center gap-3">
                <h6 class="m-0 mr-3 font-weight-bold text-primary">Participant</h6>
                <span class="font-weight-bold text-success p-2 border rounded border-success"  >Total Users: {{ $users->total() }}</span>
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
                                    <b> user id: </b>
                                    {{ $row->id }} <br>
                                    <b>name: </b>
                                    {{$row->name}} <br>

                                </p>

                            </td>
                            <td>
                              @if($row->phone)
                                <b>Phone: </b>
                                    {{$row->phone}}<br>
                              @endif

                              @if($row->email)
                                    <b>Email:</b>
                                {{$row->email}}
                                @endif
                            </td>

                            <td>
                              @if($row->dob)
                               <b>DOB:</b>
                               {{$row->dob}} <br>
                               @endif
                               
                              @if($row->gender)
                               <b>gender:</b>
                               {{$row->gender}}
                              @endif
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
