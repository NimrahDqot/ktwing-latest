
@extends('admin.app_admin')
@section('admin_content')

<h1 class="h3 mb-3 text-gray-800">Edit Event</h1>


<form action="{{ route('admin_event_update', $event->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_event_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">State</label>
                            <select name="state_id" id="state" class="my-select2-class form-control text-capitalize"  required>
                                <option value="" disabled selected>-Select State-</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ $event->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                @endforeach
                                {{-- @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">District</label>
                            <select name="district_id" id="city" class="form-control text-capitalize  my-select2-class" required>
                                <option value="" disabled selected>-Select District-</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" {{ $event->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Sub District</label>
                            <select name="sub_district_id" id="sub_district_id" class="form-control text-capitalize  my-select2-class" required>
                                <option value="" disabled selected>-Select Sub District-</option>
                                @foreach($subDistricts as $subDistrict)
                                    <option value="{{ $subDistrict->id }}" {{ $event->sub_district_id == $subDistrict->id ? 'selected' : '' }}>{{ $subDistrict->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Village Name</label>
                            <select name="village_id" id="village_id" class="form-control text-capitalize  my-select2-class" required>
                                <option value="" disabled selected>-Select Village-</option>
                                @foreach($subDistrictVillage as $villageOption)
                                    <option value="{{ $villageOption->id }}" {{ $event->village_id == $villageOption->id ? 'selected' : '' }}>{{ $villageOption->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Event Category Name</label>
                            <select name="event_category_id" class="form-control text-capitalize">
                                <option value="" disabled selected>-Select event category-</option>
                                @foreach($event_category as $category)
                                    <option value="{{ $category->id}}" {{$category->id == $event->event_category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control text-capitalize" onkeydown="return /[a-zA-Z ]/i.test(event.key)" value="{{ old('name',$event->name) }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="event_date" class="form-control"  value="{{ old('event_date',$event->event_date) }}" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Event Time</label>
                            <input type="time" name="event_time" class="form-control"  value="{{ old('event_time',$event->event_time) }}" min="{{ date('H:i A') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Event Duration</label>
                            <span class="text-danger">(In Hrs)</span>
                            <input type="number" name="event_duration" class="form-control"  value="{{ old('event_duration',$event->event_duration) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Event Agenda</label>
                            <input type="text" name="event_agenda" class="form-control"  value="{{ old('event_agenda',$event->event_agenda) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Expected Attendance</label>
                            <input type="number" name="expected_attendance" class="form-control"  value="{{ old('expected_attendance',$event->expected_attendance) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Resource List</label>
                            <input type="text" name="resoure_list" class="form-control"  value="{{ old('resoure_list',$event->resoure_list) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)"  name="image" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ asset($event->image )}}" target="_blank">
                            <img src="{{ asset($event->image )}}" alt="{{ $event->name }}" class="w_200"  id="output">
                        </a>
                    </div>

                    <div class="col-md-4">
                        <img id="output" class="w_300"/>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea id="description" name="description" class="form-control editor"
                            placeholder="Enter notification description" rows="3" required>{{ old('description',$event->description) }}</textarea>

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
            </div>

        </div>
    </form>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Change event for State dropdown
        $('#state').on('change', function() {
            var stateId = $(this).val();

            // Clear previous selections
            $('#city, #sub_district_id, #village_id').empty();
            $('#city').append('<option value="" disabled selected>-Select District-</option>');
            $('#sub_district_id').append(
                '<option value="" disabled selected>-Select Sub District-</option>');
            $('#village_id').append(
                '<option value="" disabled selected>-Select Village-</option>');

            if (stateId) {
                $.ajax({
                    url: "{{ url('/admin/get-district/') }}" + "/" + stateId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            }
        });

        // Change event for District dropdown
        $('#city').on('change', function() {
            var districtId = $(this).val();

            // Clear previous selections
            $('#sub_district_id, #village_id').empty();
            $('#sub_district_id').append(
                '<option value="" disabled selected>-Select Sub District-</option>');
            $('#village_id').append(
                '<option value="" disabled selected>-Select Village-</option>');

            if (districtId) {
                $.ajax({
                    url: "{{ url('/admin/get-sub-district/') }}" + "/" + districtId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#sub_district_id').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });

        // Change event for Sub District dropdown
        $('#sub_district_id').on('change', function() {
            var subDistrictId = $(this).val();

            // Clear previous village selection
            $('#village_id').empty();
            $('#village_id').append(
                '<option value="" disabled selected>-Select Village-</option>');

            if (subDistrictId) {
                $.ajax({
                    url: "{{ url('/admin/get-sub-district-village/') }}" + "/" + subDistrictId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#village_id').append('<option value="' +
                                value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
