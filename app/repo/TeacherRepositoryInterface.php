<?php

namespace App\repo;
//  31:00 video 18

interface TeacherRepositoryInterface
{

    // get all Teachers
    public function getAllTeachers();
    // Get specialization
    public function Getspecialization();

    // Get Gender
    public function GetGender();

    //    store teachers
    // 29:53 video 19
    public function StoreTeachers($request);

    public function EditTeachers($id);

    public function UpdateTeachers($request,$id);

    public function DestroyTeachers($id);



}
