@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Add Event</h1>

    <form action="{{ route('admin_event_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_event_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply"
                            aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">State</label>
                            <select name="state_id" id="state" class="my-select2-class form-control text-capitalize"
                                required>
                                <option value="" disabled selected>-Select State-</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">District</label>
                            <select name="district_id" id="city" class="form-control text-capitalize  my-select2-class"
                                required>
                                <option value="" disabled selected>-Select District-</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Sub District</label>
                            <select name="sub_district_id" id="sub_district_id"
                                class="form-control text-capitalize  my-select2-class" required>
                                <option value="" disabled selected>-Select Sub District-</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Village Name</label>
                            <select name="village_id" id="village_id"
                                class="form-control text-capitalize  my-select2-class" required>
                                <option value="" disabled selected>-Select Village-</option>
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
                                @foreach ($event_category as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('event_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control"
                                onkeydown="return /[a-zA-Z ]/i.test(event.key)" value="{{ old('name') }}">
                        </div>
                    </div>

                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Village Name</label>
                            <select name="village_id" class="form-control text-capitalize">
                                <option value="" disabled selected>-Select Village Name-</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}"
                                        {{ old('village_id') == $village->id ? 'selected' : '' }}>{{ $village->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="event_date" class="form-control"
                                value="{{ old('event_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Event Time</label>
                            <input type="time" id="event_time" name="event_time" value="{{ old('event_time') }}"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Event Duration</label> <span class="text-danger">(In Hrs)</span>
                            <input type="number" name="event_duration" class="form-control"
                                value="{{ old('event_duration') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Event Agenda</label>
                            <input type="text" name="event_agenda" class="form-control"
                                value="{{ old('event_agenda') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Expected Attendance</label>
                            <input type="number" name="expected_attendance" class="form-control"
                                value="{{ old('expected_attendance') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Resource List</label>
                            <input type="text" name="resoure_list" class="form-control"
                                value="{{ old('resoure_list') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Image (800x600)</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" name="image"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img id="output" class="w_150" style="cursor: pointer;" onclick="zoomImage(this)" />
                    </div>
                    <div id="modal" class="modal modal-image" onclick="closeModal()">
                        <span class="close close-image" onclick="closeModal()">&times;</span>
                        <img class="modal-image-content modal-content" id="modalImage">
                        <div id="caption"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea id="description" name="description" class="form-control editor"
                                placeholder="Enter notification description" rows="3" required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
            </div>

        </div>
    </form>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timeInput = document.getElementById('event_time');

        // Function to set minimum time
        function setMinTime() {
            const now = new Date();
            let hours = now.getHours();
            const minutes = now.getMinutes();

            // Calculate the minimum time in 24-hour format
            let minHours = hours;
            let minMinutes = minutes;

            // If current minutes are greater than 0, set min time to the next hour
            if (minutes > 0) {
                minHours = (hours + 1) % 24; // Move to the next hour
                minMinutes = 0; // Set minutes to 0 for the next full hour
            }

            // Format the min time for the input in 24-hour format
            const minTimeIn24Hour =
                `${String(minHours).padStart(2, '0')}:${String(minMinutes).padStart(2, '0')}`;

            // Set the input value to the current time in 24-hour format
            const currentTimeIn24Hour = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
            // timeInput.value = currentTimeIn24Hour;
            timeInput.min = currentTimeIn24Hour;

            // Log the minimum time for debugging
            console.log('Current Time (24-hour):', currentTimeIn24Hour);
            console.log('Minimum Time (24-hour):', minTimeIn24Hour);
        }

        setMinTime();
    });
</script>

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
