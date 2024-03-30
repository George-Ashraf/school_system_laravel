<?php
namespace App\repo;

interface LibraryRepositryInterface{
    public function index();
    public function create();
    public function store($request);
    public function download($file_name);
    public function edit($id);
    public function update($request);
    public function destroy($request);




}
