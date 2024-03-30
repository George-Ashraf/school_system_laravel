<?php

namespace App\repo;

interface FeeRepositoryInterface
{

    public function index();
    public function create();
    public function store($request);
    public function update($request);
    public function edit($id);
    public function destroy($request);
}
