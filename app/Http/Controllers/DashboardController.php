<?php

namespace App\Http\Controllers;

use App\Models\ClassModule;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\ClassConst;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $users = User::all();
        $userCount = User::count();
        $students = Student::all();
        $studentCount = Student::count();
        $classess = ClassModule::all();
        $totalClasses = ClassModule::count();
        if ($request->wantsJson()) {

            if ($users->isEmpty()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Users & Student not found in the System',
                    ],
                    404
                );
            }
            return response()->json(
                [
                    'status' => true,
                    'userdata' => $users,
                    'studentdata' => $students,
                    'message' => 'Users retrieved successfully',
                    'countUser' => $userCount,
                    'countStudent' => $studentCount,
                    'classess' => $classess,
                    'totalClasses' => $totalClasses,
                ],
                404
            );
        }
        return view('pages.dashboard',compact('users','userCount','studentCount','students','classess','totalClasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
