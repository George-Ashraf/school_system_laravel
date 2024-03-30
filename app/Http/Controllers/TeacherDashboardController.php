<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\sections;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 9:30 video 50
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = student::whereIn('section_id', $ids)->get();
        return view('teacher.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sections()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = sections::whereIn('id', $ids)->get();
        return view('teacher.sections.index', compact('sections'));
    }
    public function attendance(Request $request)
    {

        $classid = $request->section_id;

        // 30:25 video 36
        try {
            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                attendance::create([
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 3,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status
                ]);
            }


            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit_attendance(Request $request)
    {
        // 24:00 video 51
        $date = date('Y-m-d');
        $student_id = attendance::where('attendence_date', $date)->where('student_id', $request->id)->first();
        if ($request->attendences == 'presence') {
            $attendence_status = true;
        } else if ($request->attendences == 'absent') {
            $attendence_status = false;
        }
        $student_id->update([
            'attendence_status' => $attendence_status
        ]);
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
