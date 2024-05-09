@extends('backend.layouts.master')
@section('title', 'Countries')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".create" class="btn btn-primary">Create
                New Country</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Country Name</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($countries as $country)
                        <tr>
                            <th>{{$loop->index + 1}}</th>
                            <td>{{$country->name}}</td>
                            <td>
                                @if($country->status === 'hidden')
                                    <span class="badge badge-danger badge-lg">Hidden</span>
                                @else
                                    <span class="badge badge-success badge-lg">Visible</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".edit{{$country->id}}" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{route('dashboard.country.destroy', $country->id)}}" class="btn btn-sm btn-danger delete-btn">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal Edit-->
                        <div class="modal fade edit{{$country->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Country</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <form action="{{route('dashboard.country.update', $country->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xl-6  col-md-6 mb-4">
                                                    <label class="form-label font-w600">Country Name<span
                                                            class="text-danger scale5 ms-2">*</span></label>
                                                    <input type="text" name="name" value="{{$country->name}}" class="form-control solid" placeholder="Country Name">
                                                </div>
                                                <div class="col-xl-6  col-md-6 mb-4">
                                                    <label class="form-label font-w600">Status<span
                                                            class="text-danger scale5 ms-2">*</span></label>
                                                    <select name="status" class="nice-select default-select wide form-control solid">
                                                        <option value="visible" {{$country->status == 'visible' ? 'selected' : ''}}>Visible</option>
                                                        <option value="hidden" {{$country->status == 'hidden' ? 'selected' : ''}}>Hidden</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                {{$countries->links()}}
            </div>
        </div>
    </div>
    <!-- Modal Create-->
    <div class="modal fade create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{route('dashboard.country.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label font-w600">Country Name<span
                                        class="text-danger scale5 ms-2">*</span></label>
                                <input type="text" name="name" class="form-control solid" placeholder="Country Name">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label class="form-label font-w600">Status<span
                                        class="text-danger scale5 ms-2">*</span></label>
                                <select name="status" class="nice-select default-select wide form-control solid">
                                    <option value="visible" selected>Visible</option>
                                    <option value="hidden">Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
