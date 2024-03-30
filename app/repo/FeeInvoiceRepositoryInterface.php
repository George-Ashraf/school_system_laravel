<?php

namespace App\repo;

interface FeeInvoiceRepositoryInterface
{
public function index();
// 32:50 video 31
public function show($id);
public function edit($id);
public function store($request);
public function update($request);
public function destroy($id);


}
