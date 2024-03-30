<?php

namespace App\repo;

use App\Models\grades\grades;
use App\Models\student;
use Illuminate\Support\Facades\Redirect;

class GraduatedRepository implements GraduatedRepositoryInterface
{
    public function index()
    {
        // 34:17 video 17
        $students = student::onlyTrashed()->get();
        return view('graduated.index', compact('students'));
    }
    public function create()
    {
        $grades = grades::all();
        return view('graduated.create', compact('grades'));
    }
    // 23:57 video 29
    public function softdelete($request)
    {
        $students = student::where('grade_id',$request->Grade_id)->where('classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
            if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }
        // 28:47 video 29
        foreach ($students as $student){
            $ids = explode(',',$student->id);
            student::whereIn('id', $ids)->Delete();
        }
        return redirect()->route('graduated.index');

    }
    // 39:14 video 29
    public function returndata($request){
        student::onlyTrashed()->where('id', $request->id)->first()->restore();
        return redirect()->back()->with('done',trans('messages.success'));

    }
    public function destroy($request){
        student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        return redirect()->back()->with('done',trans('messages.Delete'));
    }

}
