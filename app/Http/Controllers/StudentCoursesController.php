<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentCoursesController extends Controller
{
    //
    public function getStudentCourses($id)
    {
        $info = User::with('student.studentCourses')->whereHas('student', function ($result) use ($id) {
            $result->where('national_id', $id)->orWhere('rayat_id', $id);
        })->get();
        dd($info);
        return response(['info' => $info], 200);
    }

    public function addCoursesToStudent(Request $request)
    {
        $coursesData = $this->validate($request, [
            'studentNationalId'   => 'required|string|max:10|min:10',
            "courses.*"     => "required|numeric|distinct|exists:courses,id",
            "totalHours"    => "required|numeric"
        ]);
        try {
            $user = User::where('national_id', $coursesData['studentNationalId'])->first();
            switch ($user->student->traineeState) {
                case 'employee':
                    $discount = 0.25;
                    break;
                case 'employeeSon':
                    $discount = 0.5;
                    break;
                case 'privateState':
                    $discount = 0.0;
                    break;
                default:
                    $discount = 1.0;
                    break;
            }

            $amount = $coursesData['totalHours'] * $user->student->program->hourPrice * $discount;

            if ($user->student->wallet < $amount) {
                return response(['message' => 'الرصيد لايسمح بإضافة هذه المقررات'], 422);
            } elseif (!empty($user->student->orders->where('transaction_id', null)->first())) {
                return response(['message' => 'يوجد لدى المتدرب طلب قيد المعالجة'], 422);
            }

            DB::beginTransaction();
                $order = $user->student->orders()->create(
                [
                    "amount" => $amount,
                    "requested_hours" => $coursesData['totalHours'],
                    "note"    => "الطلب تم بواسطة رئيس القسم",
                    "private_doc_verified" => true

                ]
                );
            DB::commit();
            return response(['message' => 'تم طلب اضافة المقررات بنجاح'], 200);
        } catch (QueryException $e) {
            DB::rollback();
            return response(['message' => 'حدث خطأ غير معروف اثناء اضافة المقررات'], 422);
        }
    }


    public function deleteCourseFromStudent(Request $request)
    {
        try {
            StudentCourse::where('course_id', $request->studentCourseId)->delete();
            return response(['message' => 'تم حذف المقرر بنجاح'], 200);
        } catch (QueryException $e) {
            return response(['message' => $e->getCode()], 422);
        }
    }
}
