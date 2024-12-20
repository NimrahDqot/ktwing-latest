@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ EDIT_PRIVACY_POLICY_PAGE_INFO }}</h1>

    <form action="{{ route('admin_page_privacy_update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="">{{ NAME }}</label>
                    <input type="text" name="name" class="form-control" value="{{ $page_privacy->name }}">
                </div>
                <div class="form-group">
                    <label for="">{{ DETAIL }}</label>
                    <textarea name="detail" class="form-control editor" cols="30" rows="10">{{ $page_privacy->detail }}</textarea>
                </div>
                {{-- <div class="form-group">
                    <label for="">{{ STATUS }}</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="rr1" value="Show" @if($page_privacy->status == 'Show') checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr1">{{ SHOW }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="rr2" value="Hide" @if($page_privacy->status == 'Hide') checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr2">{{ HIDE }}</label>
                        </div>
                    </div>
                </div> --}}
            </div>

                <button type="submit" class="btn btn-success">{{ UPDATE }}</button>
            </div>
        </div>
    </form>
@endsection
