<?php

namespace App\repo;

use App\Models\attendance;
use App\Models\grades\grades;
use App\Models\student;
use App\Models\teachers;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index()
    {
        $grades = grades::with(['sections'])->get();
        $list_grades = grades::all();
        $teachers = teachers::all();
        return view('attendance.sections', compact('grades', 'list_grades', 'teachers'));
    }
    public function show($id)
    {
        // 18:52 video 36
        // كل طالب تروح تجيب غيابه بناءا علي القسم الذي فيه
        $students = student::with('attendance')->where('section_id', $id)->get();
        return view('attendance.index', compact('students'));
    }

    public function store($request)
    {
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
                    'attendance_date' => date('Y-m-d'),
                    'attendance_status' => $attendence_status
                ]);
            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
