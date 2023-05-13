@extends('layout.layTea')

@section('page-content')
<div class="container my-2">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="{{ URL::to('teacher/project/' . $group_projects->id) }}">{{ __('Project') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active">{{ __('Taskboard') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ URL::to('teacher/project/' . $group_projects->id . '/team') }}">{{ __('Team') }}</a>
    </li>
  </ul>
  <div class="card text-dark border-dark my-3">
    <div class="card-body">
      <h2>{{ $group_projects->title }}</h2>
      <strong>{{ __('Team:') }}</strong> {{ $group_projects->team }}<br>
      <strong>{{ __('Advisor:') }}</strong> {{ $group_projects->advisor }}
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
  
  <div class="row row-cols-1 row-cols-md-3 g-4 my-2">
    @include('teacher.board', ['tasks' => $group_projects->tasks, 'group_project_id' => $group_projects->id])
  </div>

  
</div>
@endsection 