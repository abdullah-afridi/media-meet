<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Meeting;
use App\Models\User;
use App\Services\GoogleCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    public function index()
    {
        $data['title'] = 'Media-Meet || Meeting List';
        $data['meetings'] = Meeting::get();

        return view('meetings.index', $data);
    }
    public function __form($id = null)
    {
        $data['title'] = 'Media-Meet || Create Meeting';
        $data['attendees'] = User::whereNot('id', 1)->get();
        $data['meeting'] = false;
        if($id){
            $data['meeting'] = Meeting::find($id);
        }

        return view('meetings.__form', $data);
    }
    public function getMeetingDetails($id){
        $data['title'] = 'Media-Meet || Meeting Attendee';
        $data['meeting'] = Meeting::with(['attendees.user'])->where('id', $id)->first();
        return view('meetings.attendee.index', $data);
    }


    public function store(Request $request)
    {
        $attendee_arr = [];
        // $request->validate([
        //     'subject' => 'required|string',
        //     'meet_date' => 'required|date',
        //     'meet_time' => 'required',
        //     'attendees' => 'required|array|size:2',
        // ]);
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'meet_date' => 'required|date',
            'meet_time' => 'required',
            'attendees' => 'required|array|size:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $meeting = new Meeting();
        $meeting->subject = $request->input('subject');
        $meeting->date_time = $request->input('meet_date').' '.$request->input('meet_time');
        $meeting->save();

        foreach ($request->input('attendees') as $user_id) {
            $attendee_user = User::find($user_id);
            $attendee = new Attendee();
            $attendee->attendee_id = $attendee_user->id;
            $attendee->attendee_email = $attendee_user->email;
            $attendee->meeting_id = $meeting->id;

            // this array will be pass to google calender api';
            array_push($attendee_arr, $attendee_user->email);
            $attendee->save();
        }

        // Send an API request to create a meeting on Google Calendar
        // $googleCalendar = new GoogleCalendar();
        // $googleCalendar->createMeeting($meeting, $attendee_arr);

        return redirect('meeting')->with(['success' => 'Data Added Successfully!']);
    }

    public function update(Request $request)
    {

        // dd($request);
        $attendee_arr = [];
        // $request->validate([
        //     'subject' => 'required|string',
        //     'attendees' => 'array|size:2',
        // ]);
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'attendees' => 'array|size:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $meeting = Meeting::find($request->id);
        if($request->input('meet_date') != null){
            $form_date_time = $request->input('meet_date').' '.$request->input('meet_time') ?? '00:00:00';
        }
        $meet_data = [
            $meeting->subject = $request->input('subject'),
            $meeting->date_time = $form_date_time ?? $meeting->date_time,
        ];
        $meeting->update($meet_data);
        if($request->input('attendees')){
            foreach ($request->input('attendees') as $user_id) {
                $attendee_user = User::find($user_id);
                $attendee =Attendee::find($request->attendee_id);
                $data = [
                    $attendee->attendee_id = $attendee_user->id,
                    $attendee->attendee_email = $attendee_user->email,
                    $attendee->meeting_id = $meeting->id,
                ];
                
                // this array will be pass to google calender api';
                array_push($attendee_arr, $attendee_user->email);
                $attendee->update($data);
            }
        }

        // Send an API request to create a meeting on Google Calendar
        // $googleCalendar = new GoogleCalendar();
        // $googleCalendar->updateMeeting($meeting, $attendee_arr);

        return redirect('meeting')->with(['success' => 'Data updated Successfully!']);
    }

    public function __delete($id){
        $meeting = Meeting::find($id);
        $attendees = Attendee::where('meeting_id', $id)->delete();
        // $googleCalendar = new GoogleCalendar();
        // $googleCalendar->deleteMeeting($meeting);
        $meeting->delete();

        return redirect()->back()->with(['success' => 'Meeting deleted Successfully!']);
    }
}
