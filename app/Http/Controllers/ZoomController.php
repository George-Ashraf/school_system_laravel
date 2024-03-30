<?php

namespace App\Http\Controllers;

use App\Http\Traits\meetingzoomtrait;
use App\Models\grades\grades;
use App\Models\zoom;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom as FacadesZoom;

class ZoomController extends Controller
{

    use meetingzoomtrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zoom = zoom::all();
        return view('zoom.index', compact('zoom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = grades::all();
        return view('zoom.add', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 32:45 video 41

        $meeting = $this->createmeeting($request);
        zoom::create([
            'integration'=>true,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $meeting->id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $meeting->duration,
            'password' => $meeting->password,
            'start_url' => $meeting->start_url,
            'join_url' => $meeting->join_url,
        ]);

        return redirect()->route('zoom.index');
    }

     // 14:15 video 42
     public function indirectstore(Request $request){
        // 21:52 video 42
        $meeting = $this->createmeeting($request);
        zoom::create([
            // 31:33 video 43
            'integration'=>false,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $request->meeting_id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url,
        ]);

        return redirect()->route('zoom.index');
     }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\zoom  $zoom
     * @return \Illuminate\Http\Response
     */
    public function show(zoom $zoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\zoom  $zoom
     * @return \Illuminate\Http\Response
     */
    public function edit(zoom $zoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\zoom  $zoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, zoom $zoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\zoom  $zoom
     * @return \Illuminate\Http\Response
     */
    // 1:00:41 video 41
    public function destroy(Request $request)
    {
    //  34:45 video 42

        $info=zoom::find($request->id);
           if($info->integration==true){
            $meeting=FacadesZoom::meeting()->find($request->meeting_id);
            $meeting->delete();
            // 1:08:15 video 41
            // zoom::where('meeting_id',$request->id)->delete();
            zoom::destroy($request->id);
           }
           else{
            // zoom::where('meeting_id',$request->id)->delete();
            zoom::destroy($request->id);


           }


        return redirect()->back();
    }



    public function indirectcreate(){
        $grades = grades::all();
        return view('zoom.indirect', compact('grades'));
    }
}

