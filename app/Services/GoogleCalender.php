<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;
use App\Models\Meeting;

class GoogleCalendar
{
    protected $client;
    protected $calendar;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/google/credentials.json'));
        $this->client->addScope(Calendar::CALENDAR_EVENTS);
        $this->calendar = new Calendar($this->client);
    }

    public function createMeeting(Meeting $meeting, array $attendees)
    {
        $event = new Google_Service_Calendar_Event([
            'summary' => $meeting->subject,
            'start' => [
                'dateTime' => $meeting->date_time,
                'timeZone' => 'UTC',
            ],
            'end' => [
                'dateTime' => $meeting->date_time,
                'timeZone' => 'UTC',
            ],
            'attendees' => array_map(function ($email) {
                return ['email' => $email];
            }, $attendees),
        ]);

        $this->calendar->events->insert('primary', $event);
    }

    public function updateMeeting(Meeting $meeting, array $attendees)
    {
        $eventId = $meeting->google_event_id;

        $event = $this->calendar->events->get('primary', $eventId);

        $event->setSummary($meeting->subject);
        $event->setStart([
            'dateTime' => $meeting->date_time,
            'timeZone' => 'UTC',
        ]);
        $event->setEnd([
            'dateTime' => $meeting->date_time,
            'timeZone' => 'UTC',
        ]);

        $eventAttendees = array_map(function ($email) {
            return ['email' => $email];
        }, $attendees);
        $event->setAttendees($eventAttendees);

        $this->calendar->events->update('primary', $eventId, $event);
    }

    public function deleteMeeting(Meeting $meeting)
    {
        $eventId = $meeting->google_event_id;

        $this->calendar->events->delete('primary', $eventId);
    }
}
