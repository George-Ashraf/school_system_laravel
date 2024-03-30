<?php

namespace App\repo;

use App\Models\question;
use App\Models\quiz;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function index()
    {
        $questions = question::all();
        return view('questions.index', compact('questions'));
    }

    public function create(){
        $quizzes=quiz::all();
        return view('questions.create',compact('quizzes'));
    }

    public function store($request){
        try {
            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quizze_id;
            $question->save();
            return redirect()->route('question.index');
        }catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $question = question::findOrFail($id);
        $quizzes = quiz::get();
        return view('questions.edit',compact('question','quizzes'));
    }

    public function update($request)
    {
        try {
            $question = question::findOrFail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quizze_id;
            $question->save();
            return redirect()->route('question.index');
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($id){
        question::destroy($id);
        return redirect()->back();
    }

}
