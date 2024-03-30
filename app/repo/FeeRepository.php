<?php

namespace App\repo;

use App\Models\fees;
use App\Models\grades\grades;

class FeeRepository implements FeeRepositoryInterface
{
    public function index()
    {
        $fees = fees::all();

        return view('fees.index', compact('fees'));
    }
    public function create()
    {

        $grades = grades::all();
        return view('fees.create', compact('grades'));
    }
    public function edit($id)
    {
        $fee = fees::find($id);
        $grades = grades::all();

        return view('fees.edit', compact('fee', 'grades'));
    }
    public function store($request)
    {

        try {

            $fees = new fees();
            $fees->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fees->amount = $request->amount;
            $fees->grade_id = $request->Grade_id;
            $fees->classroom_id = $request->Classroom_id;
            $fees->notes = $request->notes;
            $fees->year = $request->year;
            $fees->fee_type=$request->Fee_type;
            $fees->save();
            return redirect()->route('fees.index')->with('done', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function update($request)
    {
        try {

            $fees = fees::find($request->id);
            $fees->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fees->amount = $request->amount;
            $fees->grade_id = $request->Grade_id;
            $fees->classroom_id = $request->Classroom_id;
            $fees->notes = $request->notes;
            $fees->year = $request->year;
            $fees->fee_type=$request->Fee_type;

            $fees->save();
            return redirect()->route('fees.index')->with('done', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            fees::destroy($request->id);
            return redirect()->back()->with('done', trans('messages.Delete'));
        }
        catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
