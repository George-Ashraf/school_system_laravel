<?php

namespace App\Http\Controllers;

use App\Http\Requests\storesections;
use App\Models\classroom;
use App\Models\grades\grades;
use App\Models\sections;
use App\Models\teachers;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 32:23 video 20
        //     $teachers=teachers::find(4);
        //   return  $teachers->sections;

        // 6:21 video 11
        // 10:42 dd() video 11
        $grades = grades::with(['sections'])->get();
        // 12:17 video 11
        $list_grades = grades::all();
        $teachers = teachers::all();
        return view('sections.index', compact('grades', 'list_grades', 'teachers'));
    }
    // 25:28 video 11
    public function getclasses($id)
    {
        $list_classes = classroom::where('Grade_id', $id)->pluck('class_name', 'id');
        // pluck احضر لي
        return $list_classes;
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
    public function store(storesections $request)
    {
        try {
            $validated = $request->validated();
            $sections = new sections();
            $sections->section_name = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $sections->grade_id = $request->Grade_id;
            $sections->class_id = $request->Class_id;
            $sections->status = 1;
            $sections->save();
            // 26:19 video 20
            // للنهاية
            $sections->teachers()->attach($request->teacher_id);
            return redirect()->back()->with('done', trans('messages.success'));
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(storesections $request, $id)
    {
        try {
            $validated = $request->validated();
            $sections = sections::find($id);
            $sections->section_name = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $sections->grade_id = $request->Grade_id;
            $sections->class_id = $request->Class_id;
            // 38:20 video 11
            if (isset($request->status)) {
                $sections->status = 1;
            } else {
                $sections->status = 2;
            }
            // update pivot tABLE
            // 9:20 video 21
            if (isset($request->teacher_id)) {
                // delete and edit : sync
                $sections->teachers()->sync($request->teacher_id);
            } else {
                $sections->teachers()->sync(array());
            }

            $sections->save();
            return redirect()->back()->with('done', trans('messages.Update'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sections = sections::find($id);
        $sections->delete();
        return redirect()->back()->with('done', trans('messages.Delete'));
    }
}
