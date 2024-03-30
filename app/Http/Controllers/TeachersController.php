<?php

namespace App\Http\Controllers;

use App\Models\gender;
use App\Models\specialization;
use App\Models\teachers;
use Illuminate\Http\Request;
use App\Http\Requests\storeteachers;

use App\repo\TeacherRepositoryInterface;


class TeachersController extends Controller
{
    // 39:05 video 18
    // error important 40:51
    // https://www.codecheef.org/article/dynamic-crud-example-with-repository-design-pattern-in-laravel
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $teachers=$this->Teacher->getAllTeachers();
       return view('teacher.index',compact('teachers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 17:00 video 19
        $genders= $this->Teacher->GetGender();
        $specializations= $this->Teacher->Getspecialization();
       return view('teacher.create',compact('genders','specializations'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeteachers $request)
    {
        return $this->Teacher->StoreTeachers($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function show(teachers $teachers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers=$this->Teacher->EditTeachers($id);
        $specializations=$this->Teacher->Getspecialization();
        $genders=$this->Teacher->GetGender();
        return view('teacher.edit',compact('teachers','specializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->Teacher->UpdateTeachers($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\teachers  $teachers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->Teacher->DestroyTeachers($id);
    }
}
