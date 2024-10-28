
@extends('admin.app_admin')
@section('admin_content')


    <h1 class="h3 mb-3 text-gray-800">Add Team</h1>

    <form action="{{ route('admin_volunteer_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_volunteer_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Role *</label>
                            <select name="role_id" id="" class="form-control" disabled>
                                <option disabled selected>--Select Role--</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}"{{ $role->name==  "volunteer" ? "selected":""}}>Team</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text"   name="name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '');"  class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text"   maxlength="10" name="phone" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  class="form-control" value="{{ old('phone') }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Password *</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Re-Enter Password *</label>
                            <input type="password" name="password_confirmation" class="form-control" value="{{ old('confirm_password') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Experience</label>
                            <input type="text" name="experience" class="form-control" value="{{ old('experience') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Blood Group</label>
                            <input type="text" name="blood_group" class="form-control" maxlength="10" value="{{ old('blood_group') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Father Name</label>
                            <input type="text" name="father_name" class="form-control"  value="{{ old('father_name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control"  value="{{ old('address') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Designation</label>
                            <input type="text" name="designation" class="form-control"   value="{{ old('designation') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Assign Team Category</label>
                            <select name="team_category_id" class="form-control text-capitalize" style="width: 100%" required>
                                <option value="" disabled>-Select Team Category-</option>
                                @foreach($team_categories as $team_category)
                                    <option value="{{ $team_category->id }}" {{old('team_category_id') == $team_category->id ? 'selected' : ''}} >{{ $team_category->name }},({{ $team_category->designation }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Assign Villages</label>
                            <select name="village_id[]" multiple class="form-control my-select2-class" style="width: 100%" required>
                                <option value="" disabled>-Select Villages-</option>
                                @foreach($villages as $village)
                            
                                    <option value="{{ $village->id }}"  {{ (is_array(old('village_id')) && in_array($village->id, old('village_id'))) ? 'selected' : '' }}>{{ $village->SubDistrictVillage->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)"  name="image" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <img id="output" class="w_150" style="cursor: pointer;" onclick="zoomImage(this)" src="{{ old('image') ? asset(old('image')) : (session('old_image_path') ? asset(session('old_image_path')) : '') }}" />
                    </div>
                    <div id="modal" class="modal modal-image" onclick="closeModal()">
                        <span class="close close-image" onclick="closeModal()">&times;</span>
                        <img class="modal-image-content modal-content" id="modalImage">
                        <div id="caption"></div>
                    </div>




                    {{-- <div class="col-md-6">
                        <div id="social_item_wrapper">
                            <div class="social_item">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <select name="social_icon[]" class="form-control">
                                                <option value="Facebook">{{ FACEBOOK }}</option>
                                                <option value="Twitter">{{ TWITTER }}</option>
                                                <option value="LinkedIn">{{ LINKEDIN }}</option>
                                                <option value="YouTube">{{ YOUTUBE }}</option>
                                                <option value="Pinterest">{{ PINTEREST }}</option>
                                                <option value="GooglePlus">{{ GOOGLE_PLUS }}</option>
                                                <option value="Instagram">{{ INSTAGRAM }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="social_url[]" class="form-control" placeholder="{{ URL }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="btn btn-success add_social_more"><i class="fas fa-plus"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-md-6">
                        <div id="social_item_wrapper">
                            @foreach(old('social_icon', ['']) as $index => $oldIcon)
                                <div class="social_item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <select name="social_icon[]" class="form-control">
                                                    <option value="Facebook" {{ $oldIcon === 'Facebook' ? 'selected' : '' }}>{{ FACEBOOK }}</option>
                                                    <option value="Twitter" {{ $oldIcon === 'Twitter' ? 'selected' : '' }}>{{ TWITTER }}</option>
                                                    <option value="LinkedIn" {{ $oldIcon === 'LinkedIn' ? 'selected' : '' }}>{{ LINKEDIN }}</option>
                                                    <option value="YouTube" {{ $oldIcon === 'YouTube' ? 'selected' : '' }}>{{ YOUTUBE }}</option>
                                                    <option value="Pinterest" {{ $oldIcon === 'Pinterest' ? 'selected' : '' }}>{{ PINTEREST }}</option>
                                                    <option value="GooglePlus" {{ $oldIcon === 'GooglePlus' ? 'selected' : '' }}>{{ GOOGLE_PLUS }}</option>
                                                    <option value="Instagram" {{ $oldIcon === 'Instagram' ? 'selected' : '' }}>{{ INSTAGRAM }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="social_url[]" class="form-control" placeholder="{{ URL }}" value="{{ old('social_url.' . $index) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="btn btn-success add_social_more"><i class="fas fa-plus"></i></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
            </div>

        </div>
    </form>
@endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".select2").select2({
            placeholder: "-Select Villages-",
            allowClear: true
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

    $(document).ready(function() {
        // Add More Social Links
        $(document).on('click', '.add_social_more', function() {
            // alert(1);
            let socialRow = `
            <div class="social_item">
                <div class="row mt-2">
                    <div class="col-md-5">
                        <div class="form-group">
                        <select name="social_icon[]" class="form-control">
                                <option value="Facebook">{{ FACEBOOK }}</option>
                                <option value="Twitter">{{ TWITTER }}</option>
                                <option value="LinkedIn">{{ LINKEDIN }}</option>
                                <option value="YouTube">{{ YOUTUBE }}</option>
                                <option value="Pinterest">{{ PINTEREST }}</option>
                                <option value="GooglePlus">{{ GOOGLE_PLUS }}</option>
                                <option value="Instagram">{{ INSTAGRAM }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" name="social_url[]" class="form-control" placeholder="{{ URL }}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn btn-danger remove_social"><i class="fas fa-trash-alt"></i></div>
                    </div>
                </div>
            </div>`;

            $('#social_item_wrapper').append(socialRow);
        });

        // Remove Social Link
        $(document).on('click', '.remove_social', function() {
            $(this).closest('.social_item').remove();
        });

    });

</script>
