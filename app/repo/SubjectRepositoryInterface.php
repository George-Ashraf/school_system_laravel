<?php
namespace App\repo;

interface SubjectRepositoryInterface {
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($id);


}
