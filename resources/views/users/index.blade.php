@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-5 d-flex justify-content-between">
        <h3>
            <b>User List</b>
        </h3>
        <div>
            <a class="btn btn-primary px-3 py-1" href="{{route('user_form')}}">Add User</a>
            <a class="btn btn-primary px-3 py-1" href="{{route('meeting_form')}}">Create Meeting</a>
        </div>
    </div>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Register_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{ \Carbon\Carbon::parse($user->create_at)->format('d M y')}}</td>
                <td>
                    <a @disabled(true) class="btn btn-warning py-0 px-1" href="">edit</a>
                    <a @disabled(true) class="btn btn-danger py-0 px-1" href="">remove</a>
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
        $('#example').DataTable();
    });
</script>
@endsection
