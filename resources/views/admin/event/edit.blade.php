
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control text-capitalize" onkeydown="return /[a-zA-Z ]/i.test(event.key)" value="{{ old('name',$event->name) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Village Name</label>
                            <select name="village_id"  class="form-control text-capitalize">
                                <option value="" disabled selected>-Select event category-</option>
                                @foreach($villages as $village)
                                    <option value="{{$village->id}}" {{$village->id == $event->village_id ? 'selected' : ''}}>{{$village->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="event_date" class="form-control"  value="{{ old('event_date',$event->event_date) }}" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Event Time</label>
                            <input type="time" name="event_time" class="form-control"  value="{{ old('event_time',$event->event_time) }}" min="{{ date('H:i A') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Event Duration</label>
                            <span class="text-danger">(In hourse)</span>
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
                            <label for="">Description</label>
                            <textarea id="description" name="description" class="form-control editor"
                            placeholder="Enter notification description" rows="3" required>{{ old('description',$event->description) }}</textarea>

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
                </div>
                <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
            </div>

        </div>
    </form>
@endsection
