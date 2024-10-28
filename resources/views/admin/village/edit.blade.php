@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Village</h1>

        <form action="{{ route('admin_village_update',$village->id) }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                    <div class="float-right d-inline">
                        <a href="{{ route('admin_village_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">State</label>
                                <select name="state_id" id="state" class="my-select2-class form-control text-capitalize"  required>
                                    <option value="" disabled selected>-Select State-</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ $village->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                    {{-- @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">District</label>
                                <select name="district_id" id="city" class="form-control text-capitalize  my-select2-class" required>
                                    <option value="" disabled selected>-Select District-</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $village->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Sub District</label>
                                <select name="sub_district_id" id="sub_district_id" class="form-control text-capitalize  my-select2-class" required>
                                    <option value="" disabled selected>-Select Sub District-</option>
                                    @foreach($subDistricts as $subDistrict)
                                        <option value="{{ $subDistrict->id }}" {{ $village->sub_district_id == $subDistrict->id ? 'selected' : '' }}>{{ $subDistrict->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Village Name</label>
                                <select name="sub_district_village_id" id="sub_district_village_id" class="form-control text-capitalize  my-select2-class" required>
                                    <option value="" disabled selected>-Select Village-</option>
                                    @foreach($subDistrictVillage as $villageOption)
                                        <option value="{{ $villageOption->id }}" {{ $village->sub_district_village_id == $villageOption->id ? 'selected' : '' }}>{{ $villageOption->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Population</label>
                                <input type="text" name="population" class="form-control" value="{{ old('population',$village->population) }}">
                            </div>
                        </div>
                     
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">language</label>
                                <input type="text" name="language" class="form-control" value="{{ old('language',$village->language) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contact</label>
                            <input type="text" maxlength="10" name="contact" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  class="form-control" value="{{ old('contact',$village->contact) }}">
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
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // Change event for State dropdown
        $('#state').on('change', function() {
            var stateId = $(this).val();

            // Clear previous selections
            $('#city, #sub_district_id, #sub_district_village_id').empty();
            $('#city').append('<option value="" disabled selected>-Select District-</option>');
            $('#sub_district_id').append('<option value="" disabled selected>-Select Sub District-</option>');
            $('#sub_district_village_id').append('<option value="" disabled selected>-Select Village-</option>');

            if(stateId) {
                $.ajax({
                    url: "{{ url('/admin/get-district/') }}" + "/" + stateId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            }
        });

        // Change event for District dropdown
        $('#city').on('change', function() {
            var districtId = $(this).val();

            // Clear previous selections
            $('#sub_district_id, #sub_district_village_id').empty();
            $('#sub_district_id').append('<option value="" disabled selected>-Select Sub District-</option>');
            $('#sub_district_village_id').append('<option value="" disabled selected>-Select Village-</option>');

            if(districtId) {
                $.ajax({
                    url: "{{ url('/admin/get-sub-district/') }}" + "/" + districtId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#sub_district_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            }
        });

        // Change event for Sub District dropdown
        $('#sub_district_id').on('change', function() {
            var subDistrictId = $(this).val();

            // Clear previous village selection
            $('#sub_district_village_id').empty();
            $('#sub_district_village_id').append('<option value="" disabled selected>-Select Village-</option>');

            if(subDistrictId) {
                $.ajax({
                    url: "{{ url('/admin/get-sub-district-village/') }}" + "/" + subDistrictId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#sub_district_village_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            }
        });
    });
</script>