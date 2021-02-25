<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentAffairsController extends Controller
{
    //

    public function checkedStudents()
    {
        $users = User::with('student')->whereHas('student', function ($result) {
            $result->where('documents_verified', true);
        })->get();
        return view('manager.studentsaAffairs.CheckedStudents')
            ->with('users', $users);
    }
}
