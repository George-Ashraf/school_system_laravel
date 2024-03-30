<?php

namespace App\repo;

use App\Models\fee_invoice;
use App\Models\fees;
use App\Models\grades\grades;
use App\Models\student;
use App\Models\student_account;
use Illuminate\Support\Facades\DB;

class FeeInvoiceRepository implements FeeInvoiceRepositoryInterface
{
    public function index()
    {
        $fee_invoices = fee_invoice::all();
        $grades = grades::all();
        return view('fee_invoice.index', compact('fee_invoices', 'grades'));
    }
    public function show($id)
    {
        // 34:00 & 39:04 video 31
        $student = student::findOrFail($id);
        $fees = fees::where('classroom_id', $student->classroom_id)->get();
        return view('fee_invoice.add', compact('student', 'fees'));
    }

    public function store($request)
    {
        // 43:52 video 31
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new fee_invoice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->grade_id = $request->Grade_id;
                $Fees->classroom_id = $request->Classroom_id;;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new student_account();
                // 45:51 video 31
                $StudentAccount->student_id = $List_Fee['student_id'];
                // $StudentAccount->grade_id = $request->Grade_id;
                $StudentAccount->fee_invoice_id = $Fees->id;
                $StudentAccount->type = 'invoice';
                $StudentAccount->date = date('Y-m-d');
                // $StudentAccount->classroom_id = $request->Classroom_id;
                $StudentAccount->debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }

            DB::commit();

            return redirect()->route('feeinvoice.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function edit($id)
    {
        // 20:00 video 32
        $fee_invoices = fee_invoice::findOrFail($id);
        $fees = fees::where('classroom_id', $fee_invoices->classroom_id)->get();
        return view('fee_invoice.edit', compact('fee_invoices', 'fees'));
    }
    public function update($request)
    {
        // 23:34 video 32
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = fee_invoice::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = student_account::where('fee_invoice_id', $request->id)->first();
            $StudentAccount->debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            return redirect()->route('feeinvoice.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }


    public function destroy($id)
    {


            // 29:00 video 32
            $fee_invoice = fee_invoice::find($id);
            $fee_invoice->delete();
            return redirect()->back();

    }
}
