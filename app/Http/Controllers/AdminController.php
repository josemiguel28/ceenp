<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $STUDENT_ROLE_ID = 2;
        $TEACHER_ROLE_ID = 3;

        $crrntUser = auth()->user()->name;
        $students = User::where('role_id', $STUDENT_ROLE_ID)->orderBy('created_at', 'desc')->paginate(10);
        $teachers = User::where('role_id', $TEACHER_ROLE_ID);
        $materias = Materia::all();

        return view('admin.dashboard', [
            'crrntUser' => $crrntUser,
            'students' => $students,
            'teachers' => $teachers,
            'materias' => $materias
        ]);
    }
}
