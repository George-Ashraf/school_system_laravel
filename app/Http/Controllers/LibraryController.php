<?php

namespace App\Http\Controllers;

use App\Models\library;
use App\repo\LibraryRepositryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected $library;
    public function __construct(LibraryRepositryInterface $library)
    {
        $this->library = $library;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->library->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->library->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->library->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\library  $library
     * @return \Illuminate\Http\Response
     */
    public function show(library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\library  $library
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->library->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\library  $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return   $this->library->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\library  $library
     * @return \Illuminate\Http\Response
     */


    public function download($file_name)
    {
        return   $this->library->download($file_name);
    }

    public function destroy(Request $request)
    {
        return  $this->library->destroy($request);
    }
}
