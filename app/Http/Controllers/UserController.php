<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all users from the database
        $users = User::all();

        // Count total number of users
        $totalUsers = User::count();
        // Check if the request expects a JSON response (API request)
        if ($request->wantsJson()) {
            // If no users exist, return error response with 404 status code
            if ($users->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'No users found in the system',
                ], 404);
            }
            // If users exist, return success response with data and count
            return response()->json([
                'status'  => true,
                'data'    => $users,
                'message' => 'Users retrieved successfully',
                'count'   => $totalUsers
            ], 200);
        }

        // Otherwise, return web response with Blade view (for web users)
        return view('pages.users.index', compact('users', 'totalUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Check if the request expects a JSON response (API request)
        if ($request->wantsJson()) {
            // Return an error response since this action is not available for API
            return response()->json([
                'status' => false,
                'message' => 'Not available for API'
            ], 400);
        }
        // Otherwise, return the Blade view for creating a new user (Web response)
        return view('pages.users.add-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'user_type' => 'nullable|string|in:admin,teacher,student,user',
        ]);

        // If validation fails
        if ($validator->fails()) {
            // API response: return validation errors in JSON
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 422);
            }
            // Web response: redirect back with validation errors and input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user record in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->input('user_type', 'user'),
            'password' => Hash::make('password'),
        ]);
        // API response: return created user with access token
        if ($request->wantsJson()) {
            $token = $user->createToken('My Token')->plainTextToken;
            return response()->json([
                'status' => true,
                'token'  => $token,
                'data'  => $user,
                'message' => 'User added successfully'
            ], 201);
        }
        // Web response: redirect to users index with success message
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        // Find the user by ID
        $user = User::find($id);
        // If user is not found
        if (!$user) {
            // API response: user not found
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User not found',
                ], 404);
            }
            // Web response: redirect back to user list with error message
            return redirect()->route('users.index')->with('error', 'User not found');
        }
        // If user is found and request expects JSON (API response)
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'User details retrieved successfully',
                'data'    => $user,
            ], 200);
        }
        // Web response: load the edit user view with user data
        return view('pages.users.edit-user', compact('user'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        // Find the user by ID
        $user = User::find($id);
        // If user is not found
        if (!$user) {
            // API response: user not found
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User not found',
                ], 404);
            }
            // Web response: redirect back to user list with error message
            return redirect()->route('users.index')->with('error', 'User not found');
        }
        // If user is found and request expects JSON (API response)
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'User details retrieved successfully',
                'data'    => $user,
            ], 200);
        }
        // Web response: load the edit user view with user data
        return view('pages.users.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find user by ID
        $user = User::find($id);
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|min:6',
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
        if (!$user) {
            // API response: return not found
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }
            // Web response: redirect back with error message
            return redirect()->route('users.index')->with('error', 'User not found');
        }
        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = 'User';
        // Update password only if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        // Save updated user to database
        $user->save();

        // API response: return success message with updated user data
        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        }
        // Web response: redirect back with success message
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Find the user by ID
        $user = User::find($id);
        // If the user does not exist
        if (!$user) {
            // API response: return error message
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User not found',
                ], 404);
            }
            // Web response: redirect back with error message
            return redirect()->route('users.index')->with('error', 'User not found');
        }
        // Delete the user from the database
        $user->delete();
        // API response: return success message with deleted user data
        if ($request->wantsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'User deleted successfully',
                'data' => $user,
            ], 200);
        }

        // Web response: redirect back with success message
        return redirect()->route('users.index')->with('danger', 'User deleted successfully');
    }
}
