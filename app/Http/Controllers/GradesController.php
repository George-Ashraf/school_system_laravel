<?php

namespace App\Http\Controllers;

use App\Models\grades\grades;
use Illuminate\Http\Request;
use App\Http\Requests\storegrades;
use App\Models\classroom;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = grades::all();
        return view('grades.index')->with('grades', $grades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storegrades $request)
    {

        // requestتم استبداله بشئ افضل في فيديو 9 في ال
        // if(grades::where('name->ar',$request->Name)->orWhere('name->en',$request->Name_en)->exists()){
        //     return redirect()->back()->withErrors(trans('grades_trans.exists'));
        // }

        try {
            $validated = $request->validated();

            $grade = new grades();
            $grade->name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $grade->notes = $request->Notes;
            $grade->save();





            return redirect()->back()->with('done', trans('messages.success'));
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grades\grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function show(grades $grades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grades\grades  $grades
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grades\grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function update(storegrades $request, $id)
    {

        try {
            $grade = grades::find($id);

            $validated = $request->validated();

            $grade->name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $grade->notes = $request->Notes;
            $grade->save();





            return redirect()->back()->with('done', trans('messages.Update'));
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grades\grades  $grades
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 9:55 video 10
        $classroom_id = classroom::where('grade_id', $id)->pluck('grade_id');

        if ($classroom_id->count() == 0) {
            $grade = grades::find($id);
            $grade->delete();
            return redirect()->back()->with('done', trans('messages.Delete'));

        }
        else {

            return redirect()->back()->with('done',trans('grades_trans.delete_Grade_Error'));
        }

    }
}
