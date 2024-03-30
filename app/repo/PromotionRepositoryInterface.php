<?php

namespace App\repo;

interface PromotionRepositoryInterface{
    public function index();
    public function store($request);
    public function create();
    public function destroy($request);


}
