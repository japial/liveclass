@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header">
                     @if ($meeting)
                        {{ $meeting->name }}
                    @else
                        Create Meeting
                    @endif
                </div>
                <div class="card-body">
                    @include('layouts.message')

                    @if ($meeting)
                      <div class="row">
                          <div class="col-md-9">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend" onclick="copyJoinUrl()" style="cursor:pointer;">
                                  <div class="input-group-text">Copy</div>
                                </div>
                                <input type="text" class="form-control" value="{{ route('attendee.join', $meeting->link) }}" id="meetingLink" placeholder="Username">
                            </div>
                          </div>
                          <div class="col-md-3">
                              <a href="{{ route('moderator.join', $meeting->id)}}" target="_blank" class="btn btn-primary mb-2">Go Live</a>
                          </div>
                      </div>
                    @else
                        <form action="{{ route('meeting.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Meeting Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="password">Meeting Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
function copyJoinUrl() {
  /* Get the text field */
  var copyText = document.getElementById("meetingLink");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");
}
</script>
@endpush
