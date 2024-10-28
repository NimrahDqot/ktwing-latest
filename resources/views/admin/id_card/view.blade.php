@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">View ID Card</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-left">
                    <form class="d-flex flex-wrap align-items-left" id="search" action="{{ route('admin_id_card_view') }}"
                        method="GET">
                        <div class="me-sm-3 ml-2 mt-2">
                            <label>
                                <input type="radio" name="filter" value="team" onchange="toggleFilter()"> Team
                            </label>
                            <label>
                                <input type="radio" name="filter" value="participant" onchange="toggleFilter()">
                                Participant
                            </label>
                        </div>

                        <div id="teamSelect" class="me-sm-3 ml-2" style="display:none;">
                            <select name="team_id" class="form-control">
                                <option selected disabled>--Select Team--</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="participantSelect" class="me-sm-3 ml-2" style="display:none;">
                            <select name="participant_id" class="form-control">
                                <option selected disabled>--Select Participant--</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-auto d-flex" style="float: right; margin-left: 100px;">
                            <div class="my-1 my-lg-0">
                                <a type="reset" href="{{ route('admin_id_card_view') }}" class="btn btn-secondary waves-effect waves-light">Clear</a>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Search</button>
                                {{-- <a type="submit" class="btn btn-danger waves-effect waves-light">View Format
                                    <img src="{{asset('uploads\business-id-card-template-with-minimalist-elements_23-2148708736.avif')}}"  alt="">
                                </a> --}}
                            </div>
                            <div class="text-lg-end">
                                <a href="{{ asset('uploads/business-id-card-template-with-minimalist-elements_23-2148708736.avif') }}"
                                   target="_blank" class="btn btn-info waves-effect waves-light">
                                   View Id-Card Format
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">

                @php
                    $data = null;
                    if ($selectedTeam) {
                        $data = $selectedTeam;
                    } elseif ($selectedParticipant) {
                        $data = $selectedParticipant;
                    }
                @endphp



                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Contact Details</th>
                            <th>Role</th>
                            <th>{{ ACTION }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp

                        @if ($data)
                                <tr>
                                    <td>
                                        <img src="{{ asset($data->image) }}" onclick="zoomImage(this)" class="w_50">
                                    </td>
                                    <td class="text-capitalize">
                                        {{ $data->name }} <br>
                                        <b>{{ $data->referal_code }}</b> <br>

                                        <span
                                            class="badge badge-pill {{ $data->status === '0' ? 'badge-warning' : ($data->status === '1' ? 'badge-success' : 'badge-danger') }} mt-2">
                                            {{ $data->status === '0' ? 'Pending' : ($data->status === '1' ? 'Active' : 'Reject') }}
                                        </span>
                                    </td>
                                    <td>Experience: {{ $data->experience }} <br> {{ $data->email }} <br>
                                        {{ $data->phone }}
                                    </td>
                                    <td class="text-capitalize">{{ optional($data->Role)->name ?? 'Not found' }}</td>


                                    <td>
                                        <a href="{{ route('id_card_download_pdf', ['id' => $data->id, 'filter' => request('filter')]) }}" class="btn btn-info btn-sm"><i class="fa fa-download"></i></a>

                                        {{-- <a href="{{ route('volunteer_id_card_download', $data->id) }}"
                                            class="btn btn-info btn-sm" target="_blank"><i class="fa fa-download"></i></a> --}}
                                        <a href="{{ route('id_card_preview', ['id' => $data->id, 'filter' => request('filter')]) }}"
                                            class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-eye"
                                                aria-hidden="true"></i></a>

                                        <br>
                                        <?php $refer_count = App\Models\Visitor::where('volunteer_id', $data->id)->count(); ?>
                                    </td>
                                </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    // Initialize the visibility of selects based on default radio selection
    document.addEventListener('DOMContentLoaded', function() {
        const defaultFilter = document.querySelector('input[name="filter"]:checked');
        if (defaultFilter) {
            toggleFilter(); // Call to set initial visibility
        }
    });

    function toggleFilter() {
        const teamSelect = document.getElementById('teamSelect');
        const participantSelect = document.getElementById('participantSelect');
        const isTeamSelected = document.querySelector('input[name="filter"]:checked')?.value === 'team';

        if (isTeamSelected) {
            teamSelect.style.display = 'block';
            participantSelect.style.display = 'none';
        } else {
            teamSelect.style.display = 'none';
            participantSelect.style.display = 'block';
        }
    }
</script>
