<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\repo\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    // 13:58 video 35 paymentشرح لل
    protected $payment;
    public function __construct(PaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->payment->index();
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
        return $this->payment->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->payment->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->payment->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->payment->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->payment->destroy($id);
    }
}
