<?php

namespace App\repo;

use App\Models\fundaccount;
use App\Models\ReceiptStudents;
use App\Models\student;
use App\Models\student_account;
use Illuminate\Support\Facades\DB;

class ReceiptStudentsRepository implements ReceiptStudentsRepositoryInterface
{

    public function index(){

        $receipt_students=ReceiptStudents::all();
        return view('receipt.index',compact('receipt_students'));
    }
    public function edit($id){
        $receipt_student=ReceiptStudents::findOrFail($id);
        return view('receipt.edit',compact('receipt_student'));
    }
    public function update($request){
        DB::beginTransaction();

        try {

            // حفظ البيانات في جدول سندات القبض
            $receipt_students =  ReceiptStudents::findOrFail($request->id);
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->debit = $request->debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // حفظ البيانات في جدول الصندوق
            // 56:20 video 33
            $fund_accounts =  fundaccount::where('receipt_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->debit = $request->debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // حفظ البيانات في جدول حساب الطالب
            $student_accounts =  student_account::where('receipt_id',$request->id)->first();
            $student_accounts->date = date('Y-m-d');
            $student_accounts->type = 'receipt';
            $student_accounts->receipt_id = $receipt_students->id;
            $student_accounts->student_id = $request->student_id;
            $student_accounts->debit = 0.00;
            $student_accounts->credit = $request->debit;
            $student_accounts->description = $request->description;
            $student_accounts->save();

            DB::commit();
            return redirect()->route('receipt_student.index');

        }

        catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }


    public function show($id)
    {
        // 35:34
        $student=student::findOrFail($id);
        return view('receipt.add',compact('student'));
    }
    public function store($request){
        // 39:00 video 33
        DB::beginTransaction();

        try {

            // حفظ البيانات في جدول سندات القبض
            $receipt_students = new ReceiptStudents();
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->debit = $request->debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // حفظ البيانات في جدول الصندوق
            $fund_accounts = new fundaccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->debit = $request->debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // حفظ البيانات في جدول حساب الطالب
            $student_accounts = new student_account();
            $student_accounts->date = date('Y-m-d');
            $student_accounts->type = 'receipt';
            $student_accounts->receipt_id = $receipt_students->id;
            $student_accounts->student_id = $request->student_id;
            $student_accounts->debit = 0.00;
            $student_accounts->credit = $request->debit;
            $student_accounts->description = $request->description;
            $student_accounts->save();

            DB::commit();
            return redirect()->route('receipt_student.index');

        }

        catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function destroy($id){
        ReceiptStudents::destroy($id);
        return redirect()->back();
    }

}
