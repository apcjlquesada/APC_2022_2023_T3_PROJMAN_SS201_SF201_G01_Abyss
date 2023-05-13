{{-- Delete Feedback --}}
<div class="modal fade" id="delete{{$feedback->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{__('Delete Feedback')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('office/feedDel') }}">
            @csrf
            @method("DELETE")
            <h4>Are you sure you want to Delete this Feedback?</h4>
            <input type="hidden" name="id" id="id" value="{{ $feedback->id }}">
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
          </form>
        </div>
      </div>
      </div>
    </div>
</div>