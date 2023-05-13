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
          <a class="nav-link" href="{{ URL::to('admin/task') }}">{{ __('Tasks') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ URL::to('admin/feedback') }}">{{ __('Feedbacks') }}</a>
        </li>
      </ul>
</div>

<div class="container my-3">
  <div class="card text-dark border-dark">
    <div class="card-body d-flex justify-content-between">
      <h3>Manage Feedback Data Table</h3>
    </div>
  </div>
</div>

<div class="d-flex justify-content-center my-2">
      <table class="mx-5 table table-sm table-bordered table-hover">
        <tr class="bg-info">
            <th>#</th>
            <th>Created By</th>
            <th>At Project ID</th>
            <th>Comment</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
      @foreach ($feedbacks as $key => $feedback)
      <tr class="table-info">
          <td>{{ $feedback->id }}</td>
          <td>{{ $feedback->user->name }}</td>
          <td>{{ $feedback->project_id }}</td>
          <td>{{ $feedback->comment }}</td>
          <td>{{ $feedback->created_at }}</td>
          <td>{{ $feedback->updated_at }}</td>
          <td>
            <a type="button" class="btn btn-primary" href="#edit{{$feedback->id}}" data-bs-toggle="modal"><i class="fa fa-edit"></i>{{ __(' Edit') }}</a>
            <a type="button" class="btn btn-danger" href="#delete{{$feedback->id}}" data-bs-toggle="modal"><i class="fa fa-trash"></i>{{ __(' Delete') }}</a>
          </td>
      </tr>

      {{-- Delete Group --}}
      <div class="modal fade" id="delete{{$feedback->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('Delete')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('admin/feedback') }}">
                @csrf 
                @method("DELETE")

                <h4>Are you sure you want to Delete: {{ $feedback->comment }}?</h4>
                <input type="hidden" id="id" name="id" value="{{ $feedback->id }}">

                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      {{-- Edit Group --}}
      <div class="modal fade" id="edit{{$feedback->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('Edit')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('admin/feedback') }}">
                @csrf 
                @method("PUT")

                <input type="hidden" id="id" name="id" value="{{ $feedback->id }}">

                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label">{{ __('Comment') }}</label>
                      <textarea class="form-control" rows="1" id="comment" name="comment" placeholder="Add Feedback">{{ $feedback->comment }}</textarea>
                    </div>
                  </div>
                </div>
                
                <input id="project_id" type="hidden" name="project_id" value="{{ $feedback->project_id }}">
      
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