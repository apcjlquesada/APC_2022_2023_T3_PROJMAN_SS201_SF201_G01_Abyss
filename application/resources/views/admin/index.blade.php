@extends('layout.layAdm')

@section('page-content')
<div class="container my-4">
    <div class="card justify-content-center text-center">
        <div class="card-body">
            <h1>Welcome {{ Auth::user()->name}}!</h1>
            <h4>You are now viewing Administration section.</h4>
        </div>
        <div class="card-footer">
            <a type="button" href="admin/user" class="btn btn-primary">{{ __('Proceed') }}</a>
            <a type="button" data-bs-toggle="modal" href="#admin" class="btn btn-warning">{{ __('Go Back') }}</a>
        </div>
    </div>
</div>
@endsection