@extends('layout.layOff')

@section('page-content')
<div class="col-3">
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
<div class="container my-4">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($group_projects as $key => $groupProject)
        <div class="col flex">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">{{ $groupProject->title }}</h3>
                    <h6>{{ $groupProject->subject }}</h6>
                    <h6>{{ $groupProject->section }}</h6>
                    <h6>{{ $groupProject->team }}</h6>
                    <h6>{{ $groupProject->advisor }}</h6>
                    <div class="dropdown position-absolute top-0 end-0 my-1 mx-2">
                      <i id="dropdownMenu" class="fa fa-ellipsis-v" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>

                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <li><a class="dropdown-item" href="{{ URL::to('office/project/' . $groupProject->id) }}">
                                {{ __('Show')}}
                            </a></li>
                            <li><a href="#edit{{$groupProject->id}}" class="dropdown-item" data-bs-toggle="modal">
                                {{ __('Edit')}}
                            </a></li>
                            <li><a href="#delete{{$groupProject->id}}" class="dropdown-item" data-bs-toggle="modal">
                                {{ __('Delete')}}
                            </a></li>  
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('office.edit')
        @endforeach
    </div>
</div>
@endsection