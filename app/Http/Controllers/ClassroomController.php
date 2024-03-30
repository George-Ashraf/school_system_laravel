<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeClassroom;
use App\Http\Requests\storegrades;
use App\Models\classroom;
use App\Models\grades\grades;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classroom = classroom::all();
        $grades = grades::all();
        return view('classrooms.index')->with('classroom', $classroom)->with('grades', $grades);
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
    public function store(storeClassroom $request)
    {


        try {

            // 20:00 video 8
            $validated = $request->validated();
            $List_Classes = $request->List_Classes;

            foreach ($List_Classes as $List_Class) {
                $classroom = new classroom();
                $classroom->class_name = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
                $classroom->grade_id = $List_Class['Grade_id'];
                $classroom->save();
            }
            return redirect()->back()->with('done', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(storeClassroom $request, $id)
    {

        try {
            $classroom = classroom::find($id);
            $classroom->class_name = ['ar' => $request->Name, 'en' => $request->Name_en];
            $classroom->grade_id = $request->Grade_id;
            $classroom->save();
            return redirect()->back()->with('done', trans('messages.Update'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $classroom = classroom::find($id);
        $classroom->delete();
        return redirect()->back()->with('done', trans('messages.Delete'));
    }
    // 38:26 video 10
    public function deleteAll(Request $request)
    {
        // explode
        // arrayتقوم بعمل
        $deleteAll_id = explode(',', $request->delete_all_id);
        // 42:49 video 10
        classroom::whereIn('id', $deleteAll_id)->delete();

        return redirect()->back()->with('done', trans('messages.Delete'));
    }
    // 53:01 video 10
    // public function filter(Request $request)
    // {
    //     $grades = grades::all();
    //     $search=classroom::select('*')->where('grade_id','=',$request->Grade_id)->get();
    //     return redirect()->route('classroom.index')->with('grades',$grades)->withDetails($search);
    // }
}
