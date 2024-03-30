<?php

namespace App\repo;

use App\Models\grades\grades;
use App\Models\quiz;
use App\Models\subject;
use App\Models\teachers;

class QuizReopsitry implements QuizReopsitryInterface
{
    public function index()
    {
        $quizzes = quiz::get();
        return view('quiz.index', compact('quizzes'));
    }

    public function create()
    {
        // 24:14 video 39
        $data['grades'] = grades::all();
        $data['subjects'] = subject::all();
        $data['teachers'] = teachers::all();
        return view('quiz.create', $data);
    }

    public function store($request)
    {
        try {

            $quizzes = new quiz();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();
            return redirect()->route('quiz.index');
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function destroy($id)
    {
        quiz::destroy($id);
        return redirect()->back();
    }

    public function edit($id)
    {
        $quizz =quiz::findorFail($id);
        $grades = grades::all();
        $subjects = subject::all();
        $teachers = teachers::all();
        return view('quiz.edit', compact('quizz','grades','subjects','teachers'));
    }
    public function update($request,$id)
    {
        try {
            $quizz = quiz::find($id);
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();
            return redirect()->route('quiz.index');
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
}
}
