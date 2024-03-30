<?php
namespace App\repo;

interface QuestionRepositoryInterface{
    public function index();
    public function create();
    public function store($request);
    public function update($request);
    public function edit($id);
    public function destroy($id);



}
