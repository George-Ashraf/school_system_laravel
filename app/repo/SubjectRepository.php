<?php

namespace App\repo;

use App\Models\grades\grades;
use App\Models\subject;
use App\Models\teachers;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects = subject::all();

        return view('subjects.index', compact('subjects'));
    }
    public function create()
    {
        $grade = grades::all();
        $teacher = teachers::all();

        return view('subjects.create', compact('grade', 'teacher'));
    }

    public function store($request)
    {
        try {
            $subjects = new subject();
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            return redirect()->route('subject.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function edit($id)
    {
        $subject = subject::findOrFail($id);
        $grades = grades::all();
        $teachers = teachers::all();
        return view('subjects.edit', compact('subject', 'grades', 'teachers'));
    }
    public function update($request)
    {
        try {
            $subjects =  subject::findOrFail($request->id);
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            return redirect()->route('subject.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function destroy($id)
    {
        subject::destroy($id);
        return redirect()->back();
    }
}
