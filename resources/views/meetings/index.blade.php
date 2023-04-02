@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-5 d-flex justify-content-between">
        <h3>
            <b>Meeting List</b>
        </h3>
        <div>
            <a class="btn btn-primary px-3 py-1" href="{{route('meeting_form')}}">Create New Meeting</a>
            {{-- <a class="btn btn-primary px-3 py-1" href="">Create Meeting</a> --}}
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if (\Session::has('success'))
            <div class="alert alert-success p-0" role="alert">                
                <ul class="m-0">
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        </div>
    </div>

    <table id="meeting-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Date Time</th>
                <th>Created_by</th>
                <th>Register_at</th>
                <th>Attendees</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meetings as $meeting)
            <tr>
                <td>{{$meeting->subject}}</td>
                <td>{{$meeting->date_time}}</td>
                <td>{{$meeting->user->name}}</td>
                <td>{{ \Carbon\Carbon::parse($meeting->create_at)->format('d M y')}}</td>
                <td><a class="btn btn-secondary py-0 px-1" href="{{route('meeting_attendees',$meeting->id)}}">attendees detail</a></td>
                <td>
                    <a class="btn btn-warning py-0 px-1" href="{{route('meeting_form',$meeting->id)}}">edit</a>
                    <a class="btn btn-danger py-0 px-1" href="{{route('meeting_delete',$meeting->id)}}">remove</a>
                </td>
            </tr>
                
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Subject</th>
                <th>Date Time</th>
                <th>Created_by</th>
                <th>Register_at</th>
                <th>Attendees</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#meeting-table').DataTable();
    });
</script>
@endsection
