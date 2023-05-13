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
  </div>
</div>
@endforeach