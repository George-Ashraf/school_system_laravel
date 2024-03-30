<?php

namespace App\repo;

interface StudentRepositoryInterface
{
    public function index();
    public function Create_Student();
    public function Store_Student($request);
    public function Edit_Student($id);
    public function Update_Student($request,$id);
    public function Show_Student($id);

    public function Destroy_Student($id);

    public function Get_classrooms($id);
    public function Get_Sections($id);

    public function Upload_attachment($request);

    public function Download_attachment($studentname,$filename);
      //Delete_attachment
    public function Delete_attachment($request);

}
