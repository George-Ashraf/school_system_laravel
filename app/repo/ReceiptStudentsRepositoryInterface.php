<?php
namespace App\repo;
interface ReceiptStudentsRepositoryInterface
{
    public function show($id);
    public function edit($id);
    public function destroy($id);

    public function update($request);


    public function store($request);
    public function index();

}
