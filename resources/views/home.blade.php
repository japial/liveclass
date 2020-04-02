@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                      <form class="form-inline">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Copy</div>
                            </div>
                            <input type="text" class="form-control" value="{{ $meeting->link }}" id="meetingLink" placeholder="Username">
                        </div>
                        <a href="#" class="btn btn-primary mb-2">Go Live</a>
                      </form>
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
