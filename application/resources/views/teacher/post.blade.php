@foreach($projects as $key => $project)
<div class="col flex my-2">
  <div class="card border-secondary">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <strong>{{ $project->user->name }}</strong>
        <strong>{{ $project->created_at}}</strong>
      </div><hr>
      <h3 class="card-title text-center">{{ $project->title }}</h3>
      <iframe class="fluid" src="/files/{{ $project->file }}" height="700:auto" width="600"></iframe><hr>
      <h6>{{ $project->description }}</h6>
    </div>
    <div class="card-footer">
      @include('teacher.feedback', ['feedbacks' => $project->feedbacks, 'project_id' => $project->id])
      <form action="{{ route('teacher/feedback') }}" method="POST" class="d-flex justify-content-between">
      @csrf
        <textarea class="form-control" rows="1" id="comment" name="comment" placeholder="Add Feedback"></textarea>
        <input id="project_id" type="hidden" name="project_id" value="{{ $project->id }}">
        <button type="submit" class="btn btn-secondary mx-2">{{ __('Send') }}</button>
      </form>
    </div>
  </div>
</div>
@endforeach