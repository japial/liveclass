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

class BigblueController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function create($id) {
        $meeting = Meeting::findOrFail($id);
        $this->setConfigValue();
        $isRecordingTrue = TRUE;
        $duration = 40;
        $participant = 51;
        try {
            $bbb = new BigBlueButton();

            $createMeetingParams = new CreateMeetingParameters($meeting->link, $meeting->name);
            $createMeetingParams->setModeratorPassword($meeting->password);
            $createMeetingParams->setAttendeePassword('password');
            $createMeetingParams->setLogoutUrl(url('/'));
            $createMeetingParams->setDuration($duration);
            $createMeetingParams->setMaxParticipants($participant);
            if ($isRecordingTrue) {
                $createMeetingParams->setRecord(true);
                $createMeetingParams->setAllowStartStopRecording(true);
                $createMeetingParams->setAutoStartRecording(true);
            }

            $response = $bbb->createMeeting($createMeetingParams);
            if ($response->getReturnCode() == 'FAILED') {
                return redirect()->route('home')->with('alert', 'Failed to Create Meeting');
            } else {
                $joinUrl = $this->getJoinUrl($meeting->link, $meeting->password);
                return redirect($joinUrl);
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('alert', 'An Error Occured');
        }
    }

    public function join($slug) {
        $this->setConfigValue();
        $meeting = Meeting::where('link', $slug)->first();
        if($meeting){
            $joinUrl = $this->getJoinUrl($meeting->link, 'password');
            return redirect($joinUrl);
        }
        return redirect()->route('home')->with('alert', 'Wrong Joining URL');
    }

    private function getJoinUrl($meetingID, $password) {
        $bbb = new BigBlueButton();
        $userData = Auth::user();
        $joinMeetingParams = new JoinMeetingParameters($meetingID, $userData->name, $password);
        $joinMeetingParams->setRedirect(true);
        $joinMeetingParams->setJoinViaHtml5(true);
        $url = $bbb->getJoinMeetingURL($joinMeetingParams);
        return $url;
    }

    private function setConfigValue() {
        $securitySalt = 'GyDfduxnfHZJgHzpuIJ0l6qr0exXTVvD45AMQheUA';
        $serverBaseUrl = 'https://classlivebd.com/bigbluebutton/';
        putenv("BBB_SECURITY_SALT=$securitySalt");
        putenv("BBB_SERVER_BASE_URL=$serverBaseUrl");
    }

}