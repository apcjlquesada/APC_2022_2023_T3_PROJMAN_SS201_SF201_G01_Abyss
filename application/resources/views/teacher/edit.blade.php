<div class="modal fade" id="edit{{$groupProject->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Edit Project')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('teacher/home') }}">
          @csrf 
          @method("PUT")

          <input type="hidden" id="id" name="id" value="{{ $groupProject->id }}">

          <div class="row mb-4">
            <div class="col">
              <div class="form-outline">
                <label class="form-label">{{ __('Project Title') }}</label>
                <input id="title" type="text" class="form-control" name="title" value="{{ $groupProject->title }}">
              </div>
            </div>
          </div>
          
          <div class="row mb-4">
            <div class="col">
              <div class="form-outline">
                <label class="form-label">{{ __('Subject') }}</label>
                <input id="subject" type="text" class="form-control" name="subject" value="{{ $groupProject->subject }}">
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <label class="form-label">{{ __('Section') }}</label>
                <input id="section" type="text" class="form-control" name="section" value="{{ $groupProject->section }}">
              </div>
            </div>
          </div>
          
          <div class="row mb-4">
            <div class="col">
              <div class="form-outline">
                <label class="form-label">{{ __('Team') }}</label>
                <input id="team" type="text" class="form-control" name="team" value="{{ $groupProject->team }}">
              </div>
            </div>
            <div class="col">
              <div class="form-outline">
                <label class="form-label">{{ __('Advisor') }}</label>
                <input id="advisor" type="text" class="form-control" name="advisor" value="{{ $groupProject->advisor }}">
              </div>
            </div>
          </div>
          
      </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary">{{ __('Update Project') }}</button>
          </div>
        </form>
    </div>
  </div>
</div>