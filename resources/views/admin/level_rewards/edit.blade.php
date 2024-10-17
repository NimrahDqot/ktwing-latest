@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Level Reward</h1>

        <form action="{{ route('admin_level_reward_update',$level_reward->id) }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
                    <div class="float-right d-inline">
                        <a href="{{ route('admin_level_reward_view') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Level Name</label>
                                <input type="text" name="level_name" class="form-control"  onkeydown="return /[a-zA-Z ]/i.test(event.key)" value="{{ old('level_name',$level_reward->level_name) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Min Points</label>
                                <input type="number" name="min_points" class="form-control" value="{{ old('min_points',$level_reward->min_points) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Max Points</label>
                                <input type="number" name="max_points" class="form-control" value="{{ old('max_points',$level_reward->max_points) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Needed Users to Qualify Level</label>
                                <input type="number" name="min_users_for_level" class="form-control"
                                    value="{{ old('min_users_for_level',$level_reward->min_users_for_level) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Award Amount</label>
                                <input type="number" name="awards_amount" class="form-control" value="{{ old('awards_amount',$level_reward->awards_amount) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Award Gift</label>
                                <input type="text" name="awads_gifts" class="form-control" min="1" maxlength="255"  value="{{ old('awads_gifts',$level_reward->awads_gifts) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Award Gift Image</label>
                                <input type="file" accept="image/*" onchange="loadFile(event)"  name="image" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <img id="output" class="w_150" style="cursor: pointer;" onclick="zoomImage(this)" src="{{ asset($level_reward->image )}}" />
                        </div>
                        <div id="modal" class="modal modal-image" onclick="closeModal()">
                            <span class="close close-image" onclick="closeModal()">&times;</span>
                            <img class="modal-image-content modal-content" id="modalImage">
                            <div id="caption"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ SUBMIT }}</button>
                </div>

            </div>
        </form>

@endsection

<script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };

</script>
