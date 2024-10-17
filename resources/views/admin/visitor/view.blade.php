@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">App Visitors</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-left">
                    <form class="d-flex flex-wrap align-items-left" id="search" action="{{ route('admin_visitor_view') }}"  method="GET">

                        <div class="me-sm-3 ml-2">
                            <select name="volunteer" class="form-control text-capitalize" id="statusFilter">
                                <option selected disabled>--Select Volunteer--</option>
                                @foreach($volunteers as $volunteer)
                                <option value="{{$volunteer->id}}"  {{ request('volunteer') == $volunteer->id ? 'selected' : '' }}> {{$volunteer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-sm-3 ml-2">
                            <select name="status" class="form-control" id="statusFilter">
                                <option selected disabled>--Visitor status--</option>
                                <option value="1"  {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0"  {{ request('status') == '0' ? 'selected' : '' }}>InActive</option>
                            </select>
                        </div>
                        <div class="me-sm-3 ml-2">
                            <select name="sort_by" class="form-control" id="statusFilter">
                                <option value="id" {{ request('sort_by') == '' ? 'selected' : '' }}>--Please select Sort by--</option>
                                <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>Id</option>
                                <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                            </select>
                        </div>

                        <div class="me-sm-3 ml-2">
                            <select name="sort_direction" class="form-control" id="sortDirectionFilter">
                                <option value="ASC" {{ request('sort_direction') == 'ASC' ? 'selected' : '' }}>Ascending</option>
                                <option value="DESC" {{ request('sort_direction') == 'DESC' ? 'selected' : '' }}>Descending</option>
                            </select>
                        </div>
                        <div class="me-sm-3 ml-2">
                            <select name="per_page"  class="form-control" id="per_page">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>all</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <a type="reset" href="{{ route('admin_visitor_view') }}" class="btn btn-secondary waves-effect waves-light">Clear</a>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">Visitors</h6>
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
                            <td class="text-capitalize">
                                @if($row->volunteers)
                                <b> Volunteer:</b>
                                {{ isset($row->volunteers->name) ? $row->volunteers->name : 'No Volunteer' }} <br>
                                @endif
                                <b> Role:</b>
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
