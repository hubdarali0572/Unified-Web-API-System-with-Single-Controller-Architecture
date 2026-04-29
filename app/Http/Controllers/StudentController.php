<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Fetch students with their related user record
        $students = Student::with('user')->get();
        // Count total number of students (before filtering, if you want total DB count)
        $totalStudent = Student::count();
        // API response
        if ($request->wantsJson()) {
            // If no students found
            if ($students->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'No Students found in the system',
                ], 404);
            }
            // Return successful JSON response
            return response()->json([
                'status'  => true,
                'data'    => $students,
                'message' => 'Student retrieved successfully',
                'count'   => $totalStudent
            ], 200);
        }

        // Web response: load view with students
        return view('pages.students.index', compact('students', 'totalStudent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Fetch all users (to associate a student with a user account)
        $users = User::all();

        // If the request expects JSON (API request)
        if ($request->wantsJson()) {
            // Return error response since student creation via API is not allowed here
            return response()->json([
                'status'  => false,
                'message' => 'Not available for API'
            ], 400);
        }

        // Otherwise, return the Blade view for adding a student admission (Web response)
        return view('pages.students.add-admission', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required|string|max:20',
            'dob'         => 'required|date',
            'age'         => 'required',
        ]);

        // If validation fails
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // ✅ Step 1: Create User entry first
            $user = User::create([
                'name'      => $request->first_name . ' ' . $request->last_name,
                'email'     => $request->email,
                'password'  => Hash::make('password'),
                'user_type' => 'Student',
            ]);

            // ✅ Step 2: Create Student entry and link it with the User
            $student = new Student();
            $student->first_name  = $request->first_name;
            $student->last_name   = $request->last_name;
            $student->father_name = $request->father_name;
            $student->email       = $request->email;
            $student->phone       = $request->phone;
            $student->dob         = $request->dob;
            $student->age         = $request->age;
            $student->user_id     = $user->id;
            $student->save();

            DB::commit(); // ✅ Commit transaction

        } catch (Exception $e) {
            DB::rollBack(); // Rollback if error

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student creation failed: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Student creation failed');
        }

        // API response
        if ($request->wantsJson()) {
            $token = auth()->user()->createToken('My Token')->plainTextToken;
            return response()->json([
                'status'      => true,
                'token'       => $token,
                'studentData' => $student,
                'userData'    => $user,
                'message'     => 'User & Student added successfully'
            ], 201);
        }

        // Web response
        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
      // Find the student by ID
        $student = Student::find($id);

        // If student does not exist
        if (!$student) {
            // API response: student not found
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Student not found',
                ], 404);
            }

            // Web response: redirect with error message
            return redirect()->route('students.index')->with('error', 'Student not found');
        }

        // API response: return student data if found
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'Student details retrieved successfully',
                'data'    => $student,
            ], 200);
        }

        // Web response: show edit admission form with student data
        return view('pages.students.edit-admission', compact('student'));
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        // Find the student by ID
        $student = Student::find($id);

        // If student does not exist
        if (!$student) {
            // API response: student not found
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Student not found',
                ], 404);
            }

            // Web response: redirect with error message
            return redirect()->route('students.index')->with('error', 'Student not found');
        }

        // API response: return student data if found
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'Student details retrieved successfully',
                'data'    => $student,
            ], 200);
        }

        // Web response: show edit admission form with student data
        return view('pages.students.edit-admission', compact('student'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student not found',
                ], 404);
            }
            return redirect()->route('students.index')->with('error', 'Student not found');
        }

        $validator = Validator::make($request->all(), [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('students')->ignore($id),
            ],
            'phone'       => 'required|string|max:20',
            'dob'         => 'required|date'
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ✅ Wrap updates in a transaction
        DB::beginTransaction();
        try {
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->father_name = $request->father_name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->dob = $request->dob;
            $student->age = $request->age;
            $student->save();

            // ✅ Update related user record
            if ($student->user_id) {
                $user = User::find($student->user_id);
                if ($user) {
                    $user->name = $request->first_name . ' ' . $request->last_name;
                    $user->email = $request->email;
                    $user->user_type = 'Student';
                    $user->save();
                }
            }

            DB::commit(); // commit transaction

        } catch (Exception $e) {
            DB::rollBack(); // rollback on error

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Update failed: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->with('error', 'Student update failed');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Student updated successfully',
                'data' => $student
            ], 200);
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Student not found',
                ], 404);
            }

            return redirect()->route('students.index')->with('error', 'Student not found');
        }

        DB::beginTransaction();
        try {
            // Delete linked user first (if exists)
            $user = User::find($student->user_id);
            if ($user) {
                $user->delete();
            }

            // Delete student
            $student->delete();

            DB::commit(); // commit transaction
        } catch (Exception $e) {
            DB::rollBack(); // rollback if something fails

            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Failed to delete student: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->route('students.index')->with('error', 'Failed to delete student');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'Student and related user deleted successfully',
                'data'    => $student,
            ], 200);
        }

        return redirect()->route('students.index')->with('danger', 'Student and related user deleted successfully');
    }
}
