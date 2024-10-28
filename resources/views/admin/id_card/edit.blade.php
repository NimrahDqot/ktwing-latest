@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Team</h1>

    <form action="{{ route('admin_volunteer_update', $volunteer->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin_volunteer_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply"
                            aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Role *</label>
                            {{-- <select name="role_id" id="" class="form-control">
                                    <option disabled selected>--Select Role--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}"{{ $volunteer->role_id == $role->id ? "selected":""}}>{{$role->name}}</option>
                                    @endforeach
                                </select> --}}
                            <select name="role_id" id="" class="form-control" disabled>
                                <option disabled selected>--Select Role--</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"{{ $role->name == 'volunteer' ? 'selected' : '' }}>
                                        Team
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');" class="form-control"
                                value="{{ old('name', $volunteer->name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $volunteer->email) }}" required>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text" maxlength="10" name="phone"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control"
                                value="{{ old('phone', $volunteer->phone) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Password *</label>
                            <input type="text" name="password" class="form-control" value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Re-Enter Password *</label>
                            <input type="text" name="password_confirmation" class="form-control"
                                value="{{ old('confirm_password') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Experience</label>
                            <input type="text" name="experience" class="form-control"
                                value="{{ old('experience', $volunteer->experience) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Blood Group</label>
                            <input type="text" name="blood_group" class="form-control" maxlength="10"
                                value="{{ old('blood_group', $volunteer->blood_group) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Father Name</label>
                            <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $volunteer->father_name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $volunteer->address) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Designation</label>
                            <input type="text" name="designation" class="form-control" value="{{ old('designation', $volunteer->designation) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Assign Team Category</label>
                            <select name="team_category_id" class="form-control text-capitalize" style="width: 100%"
                                required>
                                <option value="" disabled>-Select Team Category-</option>
                                @foreach ($team_categories as $team_category)
                                    <option value="{{ $team_category->id }}"
                                        {{ $team_category->id == $volunteer->team_category_id ? 'selected' : '' }}>
                                        {{ $team_category->name }},({{ $team_category->designation }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Assign Villages</label>
                            <select name="village_id[]" multiple class="form-control my-select2-class" style="width: 100%"
                                required>
                                <option value="" disabled>-Select Villages-</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}"   {{ in_array($village->id, explode(',', $volunteer->village_id)) ? 'selected' : '' }}>
                                        {{ $village->SubDistrictVillage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                     
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" name="image"
                                class="form-control">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ asset($volunteer->image) }}" target="_blank">
                            <img src="{{ asset($volunteer->image) }}" alt="{{ $volunteer->name }}" class="w_200"
                                id="output">
                        </a>
                    </div>

                    <div class="col-md-6">
                        <div id="social_item_wrapper">
                            <div class="social_item">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <select name="social_icon[]" class="form-control">
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
                                            <input type="text" name="social_url[]" class="form-control"
                                                placeholder="{{ URL }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="btn btn-success add_social_more"><i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($social_links->social_link))
                                @foreach ($social_links->social_link as $key => $link)
                                    <div class="social_item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <select name="social_icon[]" class="form-control">
                                                        <option value="Facebook" {{ $link->social_icon == 'Facebook' ? 'selected' :''}}>{{ FACEBOOK }}</option>
                                                        <option value="Twitter" {{ $link->social_icon == 'Twitter' ? 'selected' :''}}>{{ TWITTER }}</option>
                                                        <option value="LinkedIn" {{ $link->social_icon == 'LinkedIn' ? 'selected' :''}} >{{ LINKEDIN }}</option>
                                                        <option value="YouTube" {{ $link->social_icon == 'YouTube' ? 'selected': ''}} >{{ YOUTUBE }}</option>
                                                        <option value="Pinterest" {{ $link->social_icon == 'Pinterest' ? 'selected' :''}} >{{ PINTEREST }}</option>
                                                        <option value="GooglePlus" {{ $link->social_icon == 'GooglePlus' ? 'selected' :''}} >{{ GOOGLE_PLUS }}</option>
                                                        <option value="Instagram" {{ $link->social_icon == 'Instagram' ? 'selected' :''}} >{{ INSTAGRAM }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="social_url[]" class="form-control"
                                                        placeholder="{{ URL }}"  value="{{ $link->social_url }}">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="btn btn-danger remove_social"><i class="fas fa-trash-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endif


                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
            </div>
        </div>
    </form>

@endsection

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
