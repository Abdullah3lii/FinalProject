<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentAffairsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','errors']);
    }

    public function checkedStudents()
    {
        $users = User::with('student')->whereHas('student', function ($result) {
            $result->where('documents_verified', true);
        })->get();
        return view('manager.studentsAffairs.CheckedStudents')
            ->with('users', $users);
    }

    
    
    
    
    public function finalAcceptedForm()
    {

        $users = User::with('student')->whereHas('student', function ($result) {
            $result->where('documents_verified',true);
        })->get();

        return view('manager.studentsAffairs.studentFinalAccepted')->with(compact('users'));
    }



    public function finalAcceptedUpdate(Request $request)
    {

        $studentData = $this->validate($request, [
            "national_id"        => "required|numeric",
            "final_accepted" => "required|boolean"
        ]);

        try {
            $user = User::with('student')->where('national_id', $studentData['national_id'])->first();
            $user->student()->update([
                "final_accepted" => $studentData['final_accepted'],
            ]);

            return response(json_encode(['message' => 'تم تغيير الحالة بنجاح']), 200);
        } catch (Exception $e) {
            return response(json_encode(['message' => 'حدث خطأ غير معروف' . $e->getCode()]), 422);
        }
    }

    public function getFinalAcceptedStudents() 
    {
        try{
            $users = User::with('student')->whereHas('student', function ($result) {
                $result->where('final_accepted', true)->where('documents_verified', true);
            })->get();
            return $users;
        }catch(Exception $e){
            Log::error($e);
            return null;
        }
    }
    
    public function newStudents()
    {
        $users = $this->getFinalAcceptedStudents();
        if(isset($users)){
            return view('manager.studentsAffairs.newStudents')
            ->with('users', $users);
        }else{
            return view('manager.studentsAffairs.newStudents')->with('error',"تعذر جلب المتدربين");
        }
        
    }

    public function finalAcceptedList()
    {
        $users = $this->getFinalAcceptedStudents();
        if(isset($users)){
            return view('manager.studentsAffairs.studentFinalAcceptedList')
            ->with(compact('users'));
        }else{
            return view('manager.studentsAffairs.studentFinalAcceptedList')->with('error',"تعذر جلب المتدربين");;
        }
        
    }
}
