<?php
namespace App\Http\Traits;

use MacsiDigital\Zoom\Facades\Zoom;

// 36:59 video 41
trait meetingzoomtrait{
    public function createmeeting($request){

        $user = Zoom::user()->first();

        $meetingData = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
            // 40:28 video 41
            // 'timezone' => config('zoom.timezone')
          'timezone' => 'Africa/Cairo'
        ];
        $meeting = Zoom::meeting()->make($meetingData);
// 43:00 video 41
        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]);
        return  $user->meetings()->save($meeting);
    }
}
