<?php

namespace App\repo;

use App\Models\processingfee;
use App\Models\student;
use App\Models\student_account;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{
    public function index()
    {
        $processingfee = processingfee::all();
        return view('processing.index', compact('processingfee'));
    }
    public function show($id)
    {
        $student = student::findOrFail($id);
        return view('processing.add', compact('student'));
    }
    public function edit($id)
    {
        $processingfee = processingfee::findOrFail($id);
        return view('processing.edit', compact('processingfee'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            // حفظ البيانات في جدول معالجة الرسوم
            $ProcessingFee = new processingfee();
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new student_account();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->debit = 0.00;
            $students_accounts->credit = $request->debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            return redirect()->route('processingfee.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function update($request)
    {
        DB::beginTransaction();

        try {
            // تعديل البيانات في جدول معالجة الرسوم
            $ProcessingFee = processingfee::findOrFail($request->id);
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();

            // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = student_account::where('processing_id', $request->id)->first();;
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->debit = 0.00;
            $students_accounts->credit = $request->debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            return redirect()->route('processingfee.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        processingfee::destroy($id);
        return redirect()->back();
    }
}
