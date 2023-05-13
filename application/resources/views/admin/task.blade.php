@extends('layout.layAdm')

@section('page-content')
<div class="container my-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/user') }}">{{ __('Users') }}</a>
        </li> 
        <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('admin/group') }}">{{ __('Group Projects') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('admin/project') }}">{{ __('Projects') }}</a>
          </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ URL::to('admin/task') }}">{{ __('Tasks') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('admin/feedback') }}">{{ __('Feedbacks') }}</a>
        </li>
      </ul>
</div>

<div class="container my-3">
  <div class="card text-dark border-dark">
    <div class="card-body d-flex justify-content-between">
      <h3>Manage Tasks Data Table</h3>
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
            <th>Content</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
      @foreach ($tasks as $key => $task)
      <tr class="table-info">
          <td>{{ $task->id }}</td>
          <td>{{ $task->user->name }}</td>
          <td>{{ $task->group_project_id }}</td>
          <td>{{ $task->title }}</td>
          <td>{{ $task->content }}</td>
          <td>{{ $task->due_date }}</td>
          <td>{{ $task->status }}</td>
          <td>{{ $task->created_at }}</td>
          <td>{{ $task->updated_at }}</td>
          <td>
            <a type="button" class="btn btn-primary" href="#edit{{$task->id}}" data-bs-toggle="modal"><i class="fa fa-edit"></i>{{ __(' Edit') }}</a>
            <a type="button" class="btn btn-danger" href="#delete{{$task->id}}" data-bs-toggle="modal"><i class="fa fa-trash"></i>{{ __(' Delete') }}</a>
          </td>
      </tr>

      {{-- Delete User --}}
      <div class="modal fade" id="delete{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('Delete Task')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('admin/task') }}">
                @csrf 
                @method("DELETE")

                <h4>Are you sure you want to Delete: {{ $task->title }}?</h4>
                <input type="hidden" id="id" name="id" value="{{ $task->id }}">

                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      {{-- Edit User --}}
      <div class="modal fade" id="edit{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('Edit')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('admin/task') }}">
                @csrf 
                @method("PUT")

                <input type="hidden" id="id" name="id" value="{{ $task->id }}">

                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Title') }}</label>
                      <input id="title" type="text" class="form-control" name="title" value="{{ $task->title }}">
                    </div>
                  </div>
                </div>
      
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Content') }}</label>
                      <textarea id="content" class="form-control" rows="4" name="content">{{ $task->content }}</textarea>
                    </div>
                  </div>
                </div>
      
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Due Date') }}</label>
                      <input id="due_date" type="date" class="form-control" name="due_date" value="{{ $task->due_date }}">
                    </div>
                  </div>
                </div>
      
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <select id="status" type="date" class="form-select" name="status">
                        <option selected>{{ $task->status }}</option>
                        <option value="To Do">{{ __('To Do') }}</option>
                        <option value="In Progress">{{ __('In Progress') }}</option>
                        <option value="Finished">{{ __('Finished') }}</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <input id="group_project_id" type="hidden" name="group_project_id" value="{{ $task->group_project_id }}">
      
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