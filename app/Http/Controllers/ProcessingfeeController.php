<?php

namespace App\Http\Controllers;

use App\Models\processingfee;
use App\repo\ProcessingFeeRepositoryInterface;
use Illuminate\Http\Request;

class ProcessingfeeController extends Controller
{
    protected $processing;

    public function __construct(ProcessingFeeRepositoryInterface $processing)
    {
        $this->processing = $processing;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->processing->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->processing->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\processingfee  $processingfee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->processing->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\processingfee  $processingfee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->processing->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\processingfee  $processingfee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->processing->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\processingfee  $processingfee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->processing->destroy($id);
    }
}
