@extends('layout.layStu')

@section('page-content')
<div class="container my-2">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('project/' . $group_projects->id) }}">{{ __('Project') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('project/' . $group_projects->id . '/task') }}">{{ __('Taskboard') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active">{{ __('Team') }}</a>
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
      <div class="card-header">
        <h3 class="card-title">{{ __('List of Members') }}</h3>
      </div>
      <div class="card-body">
        @foreach ($members as $key => $member)
        {{ $member->user->name }}<hr>
        @endforeach
      </div>
    </div>
</div>
@endsection