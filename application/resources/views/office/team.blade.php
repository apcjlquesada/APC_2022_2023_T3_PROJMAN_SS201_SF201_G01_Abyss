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
        <a class="nav-link" href="{{ URL::to('office/project/' . $group_projects->id) }}">{{ __('Project') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('office/project/' . $group_projects->id . '/task') }}">{{ __('Taskboard') }}</a>
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
          {{ $member->user->name }}
          <a type="button" class="btn btn-outline-dark position-absolute end-0 mx-3" href="#delete{{$member->id}}" data-bs-toggle="modal">
              {{ __('Remove')}}
          </a>
          <br><hr>
          <div class="modal fade" id="delete{{$member->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">{{__('Remove Members')}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('office/team') }}">
                    @csrf
                    @method("DELETE")
                    <h4>Are you sure you want to remove: {{ $member->user->name }}?</h4>
                    <input type="hidden" name="id" id="id" value="{{ $member->id }}">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">{{ __('Remove') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <button class="btn btn-dark position-absolute top-0 end-0 my-2 mx-3" data-bs-toggle="modal" data-bs-target="#addModal">
        {{ __('Add Members') }}</button>
    </div>
</div>

{{-- Add Members --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Add Members')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('office/team') }}" method="POST">
          @csrf

          <select class="form-select" id="user_id" name="user_id">
            <option selected>{{ __('Select Member') }}</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>

          <input id="group_project_id" type="hidden" name="group_project_id" value="{{ $group_projects->id }}">

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ __('Add Member') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection