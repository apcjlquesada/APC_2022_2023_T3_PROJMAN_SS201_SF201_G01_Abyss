@extends('layout.layAdm')

@section('page-content')
<div class="col-3">
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show position-fixed" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show position-fixed" role="alert">
      @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
      @endforeach
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
</div>
<div class="container my-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/user') }}">{{ __('Users') }}</a>
        </li> 
        <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('admin/group') }}">{{ __('Group Projects') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ URL::to('admin/project') }}">{{ __('Projects') }}</a>
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
      <h3>Manage Projects Data Table</h3>
    </div>
  </div>
</div>

<div class="d-flex justify-content-center my-2">
      <table class="mx-5 table table-sm table-bordered table-hover">
        <tr class="bg-info">
            <th>#</th>
            <th>Created By</th>
            <th>At Group ID</th>
            <th>Title</th>
            <th>File Name</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
      @foreach ($projects as $key => $project)
      <tr class="table-info">
          <td>{{ $project->id }}</td>
          <td>{{ $project->user->name }}</td>
          <td>{{ $project->group_project_id }}</td>
          <td>{{ $project->title }}</td>
          <td>{{ $project->file }}</td>
          <td>{{ $project->description }}</td>
          <td>{{ $project->created_at }}</td>
          <td>{{ $project->updated_at }}</td>
          <td>
            <a class="btn btn-danger" href="#delete{{$project->id}}" data-bs-toggle="modal"><i class="fa fa-trash"></i>{{ __(' Delete') }}</a>
          </td>
      </tr>
      {{-- Delete Project --}}
      <div class="modal fade" id="delete{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('Delete Project')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('admin/project') }}">
                @csrf 
                @method("DELETE")

                <h4>Are you sure you want to Delete: {{ $project->title }}?</h4>
                <input type="hidden" id="id" name="id" value="{{ $project->id }}">

                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">{{ __('Delete Project') }}</button>
                </div>
              </form>
          </div>
          </div>
        </div>
      </div>
      @endforeach
    </table>
</div>


@endsection