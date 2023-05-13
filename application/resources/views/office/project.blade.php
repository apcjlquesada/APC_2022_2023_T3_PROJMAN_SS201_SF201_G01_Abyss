@extends('layout.layOff')

@section('page-content')
<div >
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

<div class="container my-2">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active">{{ __('Project') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ URL::to('office/project/' . $group_projects->id . '/task') }}">{{ __('Taskboard') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ URL::to('office/project/' . $group_projects->id . '/team') }}">{{ __('Team') }}</a>
    </li>
  </ul>
  <div class="card text-dark border-dark my-3">
      <div class="card-body">
        <h2>{{ $group_projects->title }}</h2>
        <strong>{{ __('Team:') }}</strong> {{ $group_projects->team }}<br>
        <strong>{{ __('Advisor:') }}</strong> {{ $group_projects->advisor }}
        {{-- <p>{{$tasks->percentile->status}}</p> --}}
      </div>
  </div>

  <div class="card text-dark border-dark my-3">
    <div class="card-body">
      <div class="progress">
        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" 
        aria-valuenow="{{ $tasks }}" style="width: {{ $tasks }}%" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>
  </div>
  
  <div class="row row-cols-1 row-cols-md-2 g-4 my-2">
    @include('office.post', ['projects' => $group_projects->projects, 'group_project_id' => $group_projects->id])
  </div>
</div>
@endsection 