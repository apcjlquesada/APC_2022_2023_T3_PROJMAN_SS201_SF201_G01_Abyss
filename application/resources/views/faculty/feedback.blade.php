@foreach ($feedbacks as $key => $feedback)
<div class="d-flex">
    <p><strong> {{ ($feedback->user->name .': ') }}</strong>{{ $feedback->comment}}</p>
    <div class="dropdown position-absolute end-0 mx-3">
    <i id="dropdownMenu" class="fa fa-ellipsis-v" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
            <li><a class="dropdown-item" href="#delete{{$feedback->id}}" data-bs-toggle="modal">
                {{ __('Delete')}}
            </a></li>
        </ul>
    </div>
</div><hr>
@include('faculty.feedDel')
@endforeach
