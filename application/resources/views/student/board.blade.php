@foreach($tasks as $key => $task)
<div class="col flex my-2">
  @if ($task->status == 'In Progress')
    <div class="card border-secondary text-secondary">
  @elseif ($task->status == 'Finished')
    <div class="card border-success text-success">
  @else 
    <div class="card border-primary text-primary">
  @endif
    <div class="card-header">
      <h3 class="card-title">{{ $task->title }}</h3>
    </div>
    <div class="card-body">
      <p>{{ $task->content }}</p><hr>
      <div class="d-flex justify-content-between">
        <p>{{ __('Status: '. $task->status) }}</p>
        <p>{{ __('Deadline: '. $task->due_date) }}</p>
      </div>
    </div>
    <div class="card-footer">
      <strong>{{ $task->user->name }}{{ __(' made a task.') }}</strong>
    </div>
    <a href="#edit{{$task->id}}" class="btn btn-outline-dark position-absolute top-0 end-0 my-1 mx-1" data-bs-toggle="modal">
      {{ __('Edit') }}
    </a>
  </div>
</div>

{{-- Edit Task --}}
<div class="modal fade" id="edit{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Edit Task')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('student/board') }}">
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
          
          <input id="group_project_id" type="hidden" name="group_project_id" value="{{ $group_projects->id }}">

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Update Task') }}</button>
            <a href="#delete{{$task->id}}" class="btn btn-danger" data-bs-toggle="modal">
              {{ __('Delete') }}
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Delete Task --}}
<div class="modal fade" id="delete{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Delete Task')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('student/board') }}">
          @csrf
          @method("DELETE")
          <h4>Are you sure you want to Delete Task: {{ $task->title }}?</h4>
          <input type="hidden" name="id" id="id" value="{{ $task->id }}">
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">{{ __('Delete Task') }}</button>
        <a href="#edit{{$task->id}}" class="btn btn-secondary" data-bs-toggle="modal">
          {{ __('Cancel') }}
        </a>
        </form>
      </div>
    </div>
    </div>
  </div>
</div>
@endforeach