<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeFeesRequest;
use App\Models\fees;
use App\repo\FeeRepositoryInterface;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    protected $fees;
    public function __construct(FeeRepositoryInterface $fees)
    {
        $this->fees = $fees;
    }
    public function index()
    {
        return $this->fees->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return $this->fees->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeFeesRequest $request)
    {
        return $this->fees->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function show(fees $fees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->fees->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      return  $this->fees->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->fees->destroy($request);
    }
}
