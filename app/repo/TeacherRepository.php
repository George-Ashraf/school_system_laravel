<?php

namespace App\repo;

use App\Models\gender;
use App\Models\specialization;
use App\Models\teachers;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return teachers::all();
    }
    // 17:00 video 19

    public function Getspecialization()
    {
        return specialization::all();
    }
    public function GetGender()
    {
        return gender::all();
    }

    public function StoreTeachers($request)
    {
        try {
            $teacher = new teachers();
            $teacher->email = $request->Email;
            $teacher->password = Hash::make($request->Password);
            $teacher->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $teacher->specialization_id = $request->Specialization_id;
            $teacher->gender_id = $request->Gender_id;
            $teacher->joining_date = $request->Joining_Date;
            $teacher->address = $request->Address;
            $teacher->save();
            return redirect()->route('teacher.index')->with('done', trans('messages.success'));
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function EditTeachers($id)
    {
        // 54:14 video 19
        return teachers::findOrFail($id);
    }

    public function UpdateTeachers($request, $id)
    {
        try {
            $teacher = teachers::findOrFail($id);

            $teacher->email = $request->Email;
            $teacher->password = Hash::make($request->Password);
            $teacher->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $teacher->specialization_id = $request->Specialization_id;
            $teacher->gender_id = $request->Gender_id;
            $teacher->joining_date = $request->Joining_Date;
            $teacher->address = $request->Address;
            $teacher->save();
            return redirect()->route('teacher.index')->with('done', trans('messages.Update'));
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function DestroyTeachers($id){
        $teacher=teachers::findOrFail($id);
        $teacher->delete();
        return redirect()->back()->with('done',trans('messages.Delete'));
    }

}
