@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-md-8"> --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Dashboard</h3>
                <div>
                    <button class="btn btn-primary py-1 px-3">Filter Reports</button>
                    <button class="btn btn-secondary py-1 px-3">Print</button>
                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach($meetings as $meet)
                            <div class="col-12 col-md-4 mb-3">
                                <div class="card" style="height: 100%;">
                                    <div class="card-header">
                                        <h4>{{$meet->subject}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td><b> Meeting Id:</b></td>
                                                    <td style="text-align: right">{{$meet->id}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b> Meeting DateTime:</b></td>
                                                    <td style="text-align: right">{{\Carbon\Carbon::parse($meet->date_time)->format('d M y h:m a')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b> Meeting Attendees:</b></td>
                                                    <td style="text-align: right">
                                                        <ul>
                                                            @foreach($meet->attendees as $user)
                                                            <li>{{$user->user->name}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    {{-- </div> --}}
</div>
@endsection
