@foreach($projects as $key => $project)
<div class="col flex my-2">
  <div class="card border-secondary">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <strong>{{ $project->user->name }}</strong>
        <strong>{{ $project->created_at}}</strong>
      </div><hr>
      <h3 class="card-title text-center">{{ $project->title }}</h3>
      <iframe class="fluid" src="/files/{{ $project->file }}" height="700" width="600"></iframe><hr>
      <h6>{{ $project->description }}</h6>
    </div>
    <div class="card-footer">
      @include('office.feedback', ['feedbacks' => $project->feedbacks, 'project_id' => $project->id])
      <form action="{{ route('office/feedback') }}" method="POST" class="d-flex justify-content-beetween">
      @csrf
        <textarea class="form-control" rows="1" id="comment" name="comment" placeholder="Add Feedback"></textarea>
        <input id="project_id" type="hidden" name="project_id" value="{{ $project->id }}">
        <button type="submit" class="btn btn-secondary mx-2">{{ __('Send') }}</button>
      </form>
    </div>
    <div class="dropdown position-absolute end-0 mx-3">
      <i id="dropdownMenu" class="fa-solid fa-ellipsis" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
  
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
          <a href="#delete{{$project->id}}" class="dropdown-item" data-bs-toggle="modal">
            {{ __('Delete') }}
          </a>
      </ul>
    </div>
  </div>
</div>

{{-- Delete Project --}}
<div class="modal fade" id="delete{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Delete Project')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('office/feedback') }}">
          @csrf 
          @method("DELETE")

          <h4>Are you sure you want to Delete Project: {{ $project->title }}?</h4>
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