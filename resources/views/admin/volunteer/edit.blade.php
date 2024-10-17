@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Volunteer</h1>

        <form action="{{ route('admin_volunteer_update',$volunteer->id) }}" method="post" enctype="multipart/form-data">
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
                                {{-- <select name="role_id" id="" class="form-control">
                                    <option disabled selected>--Select Role--</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}"{{ $volunteer->role_id == $role->id ? "selected":""}}>{{$role->name}}</option>
                                    @endforeach
                                </select> --}}
                                <select name="role_id" id="" class="form-control" disabled>
                                    <option disabled selected>--Select Role--</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}"{{ $role->name==  "volunteer" ? "selected":""}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');" class="form-control" value="{{ old('name', $volunteer->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $volunteer->email) }}" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Mobile</label>
                                <input type="text" maxlength="10" name="phone" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  class="form-control" value="{{ old('phone', $volunteer->phone) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Password *</label>
                                <input type="text" name="password" class="form-control" value="{{ old('password') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Re-Enter Password *</label>
                                <input type="text" name="password_confirmation" class="form-control" value="{{ old('confirm_password') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Experience</label>
                                <input type="text" name="experience" class="form-control" value="{{ old('experience', $volunteer->experience) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" accept="image/*" onchange="loadFile(event)"  name="image" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ asset($volunteer->image )}}" target="_blank">
                                <img src="{{ asset($volunteer->image )}}" alt="{{ $volunteer->name }}" class="w_200"  id="output">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Assign Villages</label>


                            <select name="village_id[]" multiple class="form-control my-select2-class" style="width: 100%" required>
                                <option value="" disabled>-Select Villages-</option>
                                @foreach($villages as $village)
                                <option value="{{ $village->id }}" {{in_array($village->id, explode(',', $volunteer->village_id)) ? 'selected' : ''}} >{{ $village->name }}</option>
                            @endforeach
                            </select>


                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
                </div>

            </div>
        </form>

@endsection


