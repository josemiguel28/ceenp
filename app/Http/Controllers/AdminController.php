<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $STUDENT_ROLE_ID = 2;

        $crrntUser = auth()->user()->name;
        $students = User::where('role_id', $STUDENT_ROLE_ID)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard', [
            'crrntUser' => $crrntUser,
            'students' => $students
        ]);
    }
}
