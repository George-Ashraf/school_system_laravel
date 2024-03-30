<?php

namespace App\Http\Controllers;

use App\Models\graduated;
use App\repo\GraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{

protected $Graduated;

public function __construct(GraduatedRepositoryInterface $Graduated)
{
$this->Graduated=$Graduated;
}

    public function index()
    {
        return $this->Graduated->index();
    }

    public function create()
    {
        return $this->Graduated->create();
    }


    public function store(Request $request)
    {
        return $this->Graduated->softdelete($request);
    }





    public function update(Request $request)
    {
      return  $this->Graduated->returndata($request);
    }


    public function destroy(Request $request)
    {
       return $this->Graduated->destroy($request);
    }
}
