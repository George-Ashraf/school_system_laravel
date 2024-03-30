<?php

namespace App\repo;

use App\Models\grades\grades;
use App\Models\promotion;
use App\Models\student;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{
    public function index()
    {
        $grades = grades::all();
        return view('promotion.index', compact('grades'));
    }

    public function store($request)
    {
        // 1:11:11 video 26
        DB::beginTransaction();

        try {
            // 37:15 video 26
            $students = student::where('grade_id', $request->Grade_id)->where('classroom_id',   $request->Classroom_id)->where('section_id', $request->section_id)->where('acadamic_year', $request->academic_year)->get();
            // 1:12:43 video 26
            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            };
            // 39:59 video 26
            // update in table student
            foreach ($students as $student) {

                $ids = explode(',', $student->id);
                // 42:01 video 26
                student::whereIn('id', $ids)->update([
                    'grade_id' => $request->Grade_id_new,
                    'classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                    // 12:19 video 27
                    'acadamic_year' => $request->academic_year_new
                ]);

                // insert in to promotions
                // 49:33 video 26
                // 1:02:00
                promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new
                ]);
            }
            DB::commit();
            return redirect()->back()->with(trans('messages.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function create()
    {
        $promotions = promotion::all();
        return view('promotion.management', compact('promotions'));
    }
    // 52:25 video 27
    public function destroy($request)
    {
        DB::beginTransaction();

        try {
            // التراجع عن الكل
            if ($request->page_id == 1) {
                // 59:45 video 27
                $promotions = promotion::all();
                foreach ($promotions as $promotion) {
                    // التحديث في جدول الطلاب
                    $ids = explode(',', $promotion->student_id);
                    student::whereIn('id', $ids)->update([
                        'grade_id' => $promotion->from_grade,
                        'classroom_id' => $promotion->from_classroom,
                        'section_id' => $promotion->from_section,
                        'acadamic_year' => $promotion->academic_year
                    ]);
                }
                // حذف جدول الترقيات
                // 1:08:13 video 27
                promotion::truncate();
                DB::commit();
                return redirect()->back()->with(trans('messages.success'));
            }
            else {
                // 16:08 video 28
                $promotion=promotion::find($request->id);
                // 18:55 video 28
                student::where('id', $promotion->student_id)->update([
                    'grade_id' => $promotion->from_grade,
                    'classroom_id' => $promotion->from_classroom,
                    'section_id' => $promotion->from_section,
                    'acadamic_year' => $promotion->academic_year
                ]);
                // 22:16 video 28
                promotion::destroy($request->id);
                DB::commit();
                return redirect()->back()->with(trans('messages.success'));
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
