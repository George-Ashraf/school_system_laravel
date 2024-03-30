<?php

namespace App\repo;

interface PaymentRepositoryInterface
{
    public function index();
    public function show($id);
    public function edit($id);
    public function destroy($id);
    public function update($request);
    public function store($request);
}
