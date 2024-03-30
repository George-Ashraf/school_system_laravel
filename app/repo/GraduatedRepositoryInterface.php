<?php

namespace App\repo;

interface GraduatedRepositoryInterface{
    public function index();
    public function create();
    public function softdelete($request);
    public function returndata($request);
    public function destroy($request);



}
