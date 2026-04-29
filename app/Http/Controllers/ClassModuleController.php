<?php

namespace App\Http\Controllers;

use App\Models\ClassModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $classess = ClassModule::all();
        $totalClasses = ClassModule::count();

        if ($request->wantsJson()) {

            if ($classess->isEmpty()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Class is not present in System'
                    ],
                    404
                );
            }
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Class getting Successfully !!',
                    'data' => $classess,
                    'count' => $totalClasses
                ],
                200
            );
        }

        return view('pages.classess.index', compact('classess', 'totalClasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.classess.add-classess');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'class_name' => 'required',
                'shift' => 'required',
                'section' => 'required',
            ]
        );
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

        $class = new ClassModule();
        $class->class_name  = $request->class_name;
        $class->shift   = $request->shift;
        $class->section = $request->section;
        $class->save();


        // API response
        if ($request->wantsJson()) {
            $token = auth()->user()->createToken('My Token')->plainTextToken;

            return response()->json([
                'status'      => true,
                'token'       => $token,
                'data' => $class,
                'message'     => 'Class added successfully'
            ], 201);
        }

        // Web response
        return redirect()->route('class.index')->with('success', 'Class added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        // Find the user by ID
        $class = ClassModule::find($id);
        // If user is not found
        if (!$class) {
            // API response: user not found
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Class not found',
                ], 404);
            }
            // Web response: redirect back to user list with error message
            return redirect()->route('class.index')->with('error', 'Class not found');
        }
        // If user is found and request expects JSON (API response)
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'Class details retrieved successfully',
                'data'    => $class,
            ], 200);
        }
        // Web response: load the edit user view with user data
        return view('pages.classess.edit-classess', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        // Find the user by ID
        $class = ClassModule::find($id);
        // If user is not found
        if (!$class) {
            // API response: user not found
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Class not found',
                ], 404);
            }
            // Web response: redirect back to user list with error message
            return redirect()->route('class.index')->with('error', 'Class not found');
        }
        // If user is found and request expects JSON (API response)
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'Class details retrieved successfully',
                'data'    => $class,
            ], 200);
        }
        // Web response: load the edit user view with user data
        return view('pages.classess.edit-classess', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find user by ID
        $class = ClassModule::find($id);
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'shift' => 'required',
          
        ]);
        // If validation fails
        if ($validator->fails()) {
            // API response: return validation errors
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 422);
            }
            // Web response: redirect back with validation errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If user not found
        if (!$class) {
            // API response: return not found
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Class not found',
                ], 404);
            }
            // Web response: redirect back with error message
            return redirect()->route('class.index')->with('error', 'Class not found');
        }
        // Update user details
        $class->class_name = $request->class_name;
        $class->section = $request->section;
        $class->shift =$request->shift;
        $class->save();

        // API response: return success message with updated user data
        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Class updated successfully',
                'data' => $class
            ], 200);
        }
        // Web response: redirect back with success message
        return redirect()->route('class.index')->with('success', 'Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Find the user by ID
        $class = ClassModule::find($id);
        // If the user does not exist
        if (!$class) {
            // API response: return error message
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Class not found',
                ], 404);
            }
            // Web response: redirect back with error message
            return redirect()->route('class.index')->with('error', 'Class not found');
        }
        // Delete the user from the database
        $class->delete();
        // API response: return success message with deleted user data
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'Class deleted successfully',
                'data' => $class,
            ], 200);
        }

        // Web response: redirect back with success message
        return redirect()->route('class.index')->with('danger', 'Class deleted successfully');
    }
}
