<?php

namespace App\repo;

use App\Models\fundaccount;
use App\Models\payment;
use App\Models\student;
use App\Models\student_account;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
        $payment = payment::all();
        return view('payment.index', compact('payment'));
    }

    // 16:58 video 35
    public function show($id)
    {
        $student = student::findOrFail($id);
        return view('payment.add', compact('student'));
    }
    public function edit($id)
    {
        $payment = payment::findOrFail($id);
        return view('payment.edit', compact('payment'));
    }
    public function update($request)
    {
        DB::beginTransaction();

        try {

            // تعديل البيانات في جدول سندات الصرف
            $payment_students = payment::findOrFail($request->id);
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = fundaccount::where('payment_id', $request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->debit = 0.00;
            $fund_accounts->credit = $request->debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = student_account::where('payment_id', $request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->debit = $request->debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();
            DB::commit();
            return redirect()->route('payment.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            // 19:47 video 35
            // حفظ البيانات في جدول سندات الصرف
            $payment_students = new payment();
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = new fundaccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->debit = 0.00;
            $fund_accounts->credit = $request->debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new student_account();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->debit = $request->debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            return redirect()->route('payment.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($id){
        payment::destroy($id);
        return redirect()->back();
    }
}
