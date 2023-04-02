@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-5 d-flex justify-content-between">
        <h3>
            <b>Meeting Details</b>
        </h3>
        <div>
            {{-- <a class="btn btn-primary px-3 py-1" href="{{route('meeting_form')}}">Create New Meeting</a> --}}
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
    <div class="row mb-5">
        <div class="col-12">
            <table id="" class="" style="width:100%">
                <tbody>
                    <tr>
                        <td><b>Meeting Subject:</b></td>
                        <td>{{$meeting->subject}}</td>
                        <td><b>Meeting Date/Time:</b></td>
                        <td>{{$meeting->date_time}}</td>
                    </tr>
                    <tr><td><div class="mb-4"></div></td></tr>
                    <tr>
                        <td><b>Registeded By:</b></td>
                        <td>{{$meeting->user->name}}</td>
                        <td><b>Registered At:</b></td>
                        <td>{{ \Carbon\Carbon::parse($meeting->create_at)->format('d M y')}}</td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>
    <div class="row">
        <div class="col col-md-12">
            <h3>
                <b>Meeting Attendees List</b>
            </h3>
        </div>

    </div>

    <table id="meeting-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Register_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meeting->attendees as $user)
            <tr>
                <td>{{$user->user->name}}</td>
                <td>{{$user->user->email}}</td>
                <td>{{ \Carbon\Carbon::parse($user->user->create_at)->format('d M y')}}</td>
                <td>
                    {{-- <a class="btn btn-warning py-0 px-1" href="">edit</a> --}}
                    <a class="btn btn-danger py-0 px-1" href="">remove</a>
                </td>
            </tr>
                
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Register_at</th>
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
