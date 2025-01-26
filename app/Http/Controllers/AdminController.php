<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $crrntUser = auth()->user()->name;
        $totalStudents = User::where('role_id', 2)->count();

        return view('admin.dashboard', [
            'crrntUser' => $crrntUser,
            'totalStudents' => $totalStudents
        ]);
    }
}
