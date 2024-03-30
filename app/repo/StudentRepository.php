<?php

namespace App\repo;

use App\Models\blood_type;
use App\Models\classroom;
use App\Models\gender;
use App\Models\grades\grades;
use App\Models\img;
use App\Models\my_parent;
use App\Models\nationality;
use App\Models\sections;
use App\Models\student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{
    public function index()
    {

        // 28:21 video 24
        // $student = student::find(2);
        // $x=$student->images;
        // dd($x);
        $students = student::get();
        return view('student.index', compact('students'));
    }


    public function Create_Student()
    {
        // 16:00 video 22
        $data['my_classes'] = grades::all();
        $data['parents'] = my_parent::all();
        $data['Genders'] = gender::all();
        $data['nationals'] = nationality::all();
        $data['bloods'] = blood_type::all();
        return view('student.create', $data);
    }
    public function Store_Student($request)
    {
        // 1:01:33 video 24
        DB::beginTransaction();

        try {
            $students = new student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->birth_date = $request->Date_Birth;
            $students->grade_id = $request->Grade_id;
            $students->classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->acadamic_year = $request->academic_year;
            $students->save();
            // 41:29 video 24
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $students->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new img();
                    $images->filename = $name;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\student';
                    $images->save();
                }
            }


            DB::commit();

            return redirect()->route('student.index')->with('done', trans('messages.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function Edit_Student($id)
    {
        $data['Grades'] = grades::all();
        $data['parents'] = my_parent::all();
        $data['Genders'] = gender::all();
        $data['nationals'] = nationality::all();
        $data['bloods'] = blood_type::all();
        //
        $Students =  student::findOrFail($id);
        return view('student.edit', $data, compact('Students'));
    }
    public function Update_Student($request, $id)
    {
        try {
            $students = student::findOrFail($id);
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->birth_date = $request->Date_Birth;
            $students->grade_id = $request->Grade_id;
            $students->classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->acadamic_year = $request->academic_year;
            $students->save();
            return redirect()->route('student.index')->with('done', trans('messages.success'));
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function Show_Student($id)
    {
        $Student = student::findOrFail($id);
        return view('student.show', compact('Student'));
    }


    public function Get_classrooms($id)
    {
        // 37:33 video 22
        $list_classes = classroom::where("grade_id", $id)->pluck("class_name", "id");
        return $list_classes;
    }


    //Get Sections
    public function Get_Sections($id)
    {
        // 41:44 video 22
        $list_sections = sections::where("class_id", $id)->pluck("section_name", "id");
        return $list_sections;
    }

    public function Destroy_student($id)
    {
        // 59:55 video 23
        // student::destroy($id);
        student::findOrFail($id)->Delete();
        return redirect()->back()->with('done', trans('messages.Delete'));
    }
    public function Upload_attachment($request)
    {
        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/' . $request->student_name, $file->getClientOriginalName(), 'upload_attachments');

            // insert in image_table
            $images = new img();
            $images->filename = $name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        return redirect()->back()->with('done', trans('messages.success'));
    }
    // 41:24 video 25
    public function Download_attachment($studentname, $filename)
    {
        return response()->download(public_path('attachments/students/' . $studentname . '/' . $filename));
    }

    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        img::where('id',$request->id)->where('filename',$request->filename)->delete();

        return redirect()->route('student.show',$request->student_id)->with('done',trans('messages.Delete'));
    }

}
