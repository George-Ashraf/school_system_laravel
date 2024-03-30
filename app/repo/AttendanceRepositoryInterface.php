<?php

namespace App\repo;

interface AttendanceRepositoryInterface{
    public function index();
    public function show($id);
    public function store($request);


}
