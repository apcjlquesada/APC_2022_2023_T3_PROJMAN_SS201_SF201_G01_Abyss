@extends('layout.layAdm')

@section('page-content')
<div class="container my-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/user') }}">{{ __('Users') }}</a>
        </li> 
        <li class="nav-item">
            <a class="nav-link active" href="{{ URL::to('admin/group') }}">{{ __('Group Projects') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('admin/project') }}">{{ __('Projects') }}</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/task') }}">{{ __('Tasks') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('admin/feedback') }}">{{ __('Feedbacks') }}</a>
        </li>
      </ul>
</div>

<div class="container my-3">
  <div class="card text-dark border-dark">
    <div class="card-body d-flex justify-content-between">
      <h3>Manage Group Projects Data Table</h3>
    </div>
  </div>
</div>

<div class="d-flex justify-content-center my-2">
      <table class="mx-5 table table-sm table-bordered table-hover">
        <tr class="bg-info">
            <th>#</th>
            <th>By User ID</th>
            <th>Title</th>
            <th>Subject</th>
            <th>Section</th>
            <th>Team</th>
            <th>Adviser</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
      @foreach ($group_projects as $key => $groupProject)
      <tr class="table-info">
          <td>{{ $groupProject->id }}</td>
          <td>{{ $groupProject->user_id }}</td>
          <td>{{ $groupProject->title }}</td>
          <td>{{ $groupProject->subject }}</td>
          <td>{{ $groupProject->section }}</td>
          <td>{{ $groupProject->team }}</td>
          <td>{{ $groupProject->advisor }}</td>
          <td>{{ $groupProject->created_at }}</td>
          <td>{{ $groupProject->updated_at }}</td>
          <td>
            <a type="button" class="btn btn-primary" href="#edit{{$groupProject->id}}" data-bs-toggle="modal"><i class="fa fa-edit"></i>{{ __(' Edit') }}</a>
            <a type="button" class="btn btn-danger" href="#delete{{$groupProject->id}}" data-bs-toggle="modal"><i class="fa fa-trash"></i>{{ __(' Delete') }}</a>
          </td>
      </tr>

      {{-- Delete Group --}}
      <div class="modal fade" id="delete{{$groupProject->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('Delete Group')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('admin/group') }}">
                @csrf 
                @method("DELETE")

                <h4>Are you sure you want to Delete: {{ $groupProject->title }}?</h4>
                <input type="hidden" id="id" name="id" value="{{ $groupProject->id }}">

                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      {{-- Edit Group --}}
      <div class="modal fade" id="edit{{$groupProject->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('Edit Group')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('admin/group') }}">
                @csrf 
                @method("PUT")

                <input type="hidden" id="id" name="id" value="{{ $groupProject->id }}">
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Project Title') }}</label>
                      <input id="title" type="text" class="form-control" name="title" value="{{ $groupProject->title }}">
                    </div>
                  </div>
                </div>
                
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Subject') }}</label>
                      <input id="subject" type="text" class="form-control" name="subject" value="{{ $groupProject->subject }}">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Section') }}</label>
                      <input id="section" type="text" class="form-control" name="section" value="{{ $groupProject->section }}">
                    </div>
                  </div>
                </div>
                
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Team') }}</label>
                      <input id="team" type="text" class="form-control" name="team" value="{{ $groupProject->team }}">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Advisor') }}</label>
                      <input id="advisor" type="text" class="form-control" name="advisor" value="{{ $groupProject->advisor }}">
                    </div>
                  </div>
                </div>
      
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">{{ __('Update Details') }}</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      @endforeach
    </table>
</div>
@endsection