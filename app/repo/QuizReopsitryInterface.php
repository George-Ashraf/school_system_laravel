<?php
namespace App\repo;

interface QuizReopsitryInterface{
    public function index();
    public function create();
    public function store($request);
    public function destroy($id);
    public function edit($id);
    public function update($request,$id);




}
