@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Meeting Form</h3>
            </div>
        </div>
        <div class="row justify-content-center">

            <form method="post"
                @if ($meeting) action="{{ route('update_meeting') }}"  @else action="{{ route('create_meeting') }}" @endif>
                @csrf
                @if ($meeting)
                    <input type="hidden" name="id" value="{{ $meeting->id }}">
                @endif
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group my-4">
                            <label style="font-weight: 700" for="exampleFormControlInput1">Enter Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="exampleFormControlInput1" name="subject"
                                value="{{ $meeting->subject ?? '' }}" placeholder="Meeting subject">
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group my-4">
                            <label style="font-weight: 700" for="exampleFormControlInput1">Date Time</label>

                            <input type="date" class="form-control @error('meet_date') is-invalid @enderror" id="exampleFormControlInput1" name="meet_date"
                                value="" placeholder="Date time">
                                @error('meet_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if($meeting)
                            <p>Current meeting Date:
                                {{ $meeting ? \Carbon\Carbon::parse($meeting->date_time)->format('d M Y') : '' }}</p>
                                @endif
                            </div>

                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group my-4">
                            <label style="font-weight: 700" for="exampleFormControlInput1">Date Time</label>
                            <input type="time" class="form-control @error('meet_time') is-invalid @enderror" id="exampleFormControlInput1" name="meet_time"
                                value="" placeholder="Date time">
                                @error('meet_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if($meeting)
                            <p>Current meeting Time:
                                    {{ $meeting ? \Carbon\Carbon::parse($meeting->date_time)->format('h:m a') : '' }}</p>
                                @endif
                            </div>

                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group my-4">
                            <label style="font-weight: 700" for="exampleFormControlSelect2">Example multiple select</label>
                            <select multiple class="form-control @error('attedees') is-invalid @enderror" id="exampleFormControlSelect2" name="attendees[]">
                                @foreach ($attendees as $attendee)
                                    <option value="{{ $attendee->id }}">{{ $attendee->name }}</option>
                                @endforeach
                            </select>
                            @error('attendes[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        @if ($meeting)
                            <p class="p-0 mb-0"><b>Current Attendees:</b>
                                <?php $i = 1; ?>
                                @foreach ($meeting->attendees as $value)
                                    {{ $i++ }}<span>).</span> {{ $value->user->name }}
                                @endforeach
                            </p>
                            <p class="text-danger p-0">If you want to update please select new attendees otherwise leave it
                                null</p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <div class="form-group my-4">
                            <button class="btn btn-primary" type="submit">Create Meeting</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
