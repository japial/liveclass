<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\DeleteRecordingsParameters;
use Illuminate\Support\Facades\Auth;
use App\Meeting;

class BigblueController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create($id)
    {
        $meeting = Meeting::findOrFail($id);
        $this->setConfigValue();
        $isRecordingTrue = TRUE;
        $duration = 40;
        $participant = 51;
        try {
            $bbb = new BigBlueButton();

            $createMeetingParams = new CreateMeetingParameters($meeting->link, $meeting->name);
            $createMeetingParams->setAttendeePassword($meeting->attendee);
            $createMeetingParams->setModeratorPassword($meeting->moderator);
            $createMeetingParams->setLogoutUrl(base_url());
            $createMeetingParams->setDuration($duration);
            $createMeetingParams->setMaxParticipants($participant);
            if ($isRecordingTrue) {
                $createMeetingParams->setRecord(true);
                $createMeetingParams->setAllowStartStopRecording(true);
                $createMeetingParams->setAutoStartRecording(true);
            }

            $response = $bbb->createMeeting($createMeetingParams);
            if ($response->getReturnCode() == 'FAILED') {
                redirect()->route('home')->with('alert', 'Failed to Create Meeting');
            } else {
                $joinUrl = $this->getJoinUrl($meeting->mid, $meeting->moderator);
                redirect($joinUrl);
            }
        } catch (\Exception $e) {
             redirect('/live/meeting/');
        }
    }

    public function join($id)
    {
        $this->setConfigValue();
        $meeting = Meeting::findOrFail($id);
        $joinUrl = $this->getJoinUrl($meeting->mid, $meeting->attendee);
        redirect($joinUrl);
    }

    private function getJoinUrl($meetingID, $password)
    {
        $bbb = new BigBlueButton();
        $userData = Auth::user();
        $joinMeetingParams = new JoinMeetingParameters($meetingID,  $userData->name, $password);
        $joinMeetingParams->setRedirect(true);
        $joinMeetingParams->setJoinViaHtml5(true);
        $url = $bbb->getJoinMeetingURL($joinMeetingParams);
        return $url;
    }

    private function setConfigValue()
    {
        $securitySalt = 'GyDfduxnfHZJgHzpuIJ0l6qr0exXTVvD45AMQheUA';
        $serverBaseUrl = 'https://classlivebd.com/bigbluebutton/';
        putenv("BBB_SECURITY_SALT=$securitySalt");
        putenv("BBB_SERVER_BASE_URL=$serverBaseUrl");
    }
}
