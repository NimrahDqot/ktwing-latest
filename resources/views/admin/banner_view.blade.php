@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800 text-capitalize">{{ request('type')}}</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-left">
                    <form class="d-flex flex-wrap align-items-left" id="search" action="{{ route('admin_banner_view') }}"  method="GET">
                        <div class="me-sm-3 ml-2">
                            <select name="type" class="form-control" id="statusFilter">
                                <option selected disabled>--Select type--</option>
                                <option value="banner"   {{ request('type') == 'banner' ? 'selected' : '' }}>Banner</option>
                                <option value="logo"   {{ request('type') == 'logo' ? 'selected' : '' }}>Logo</option>
                                <option value="rewards"   {{ request('type') == 'rewards' ? 'selected' : '' }}>Rewards</option>
                                <option value="offer"   {{ request('type') == 'offer' ? 'selected' : '' }}  class="offer-select">Offers</option>

                            </select>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <a type="reset" href="{{ route('admin_banner_view') }}" class="btn btn-secondary waves-effect waves-light">Clear</a>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin_banner_create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{ ADD_NEW }}</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ SERIAL }}</th>
                        <th>Image</th>
                        <th>{{ TITLE }}</th>

                        <th>Type</th>
                        <th>{{ ACTION }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($banner as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              <img src="{{ asset($row->image) }}" style="cursor: pointer;" onclick="zoomImage(this)" class="w_50">
                            </td>
                            <td>{{ $row->title }}</td>
                            <td>{{ ucfirst($row->type) }} <b>{{$row->offer_amount}}</b> </td>
                            <td>
                                <a href="{{ route('admin_banner_edit',$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin_banner_delete',$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ ARE_YOU_SURE }}');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="modal" class="modal modal-image" onclick="closeModal()">
                    <span class="close close-image" onclick="closeModal()">&times;</span>
                    <img class="modal-image-content modal-content" id="modalImage">
                    <div id="caption"></div>
                </div>
                <div class="col-12">
                    {{ $banner->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
