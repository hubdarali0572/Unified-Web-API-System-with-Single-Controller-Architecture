<?php

namespace App\Http\Controllers\api;


use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register the User Api

    public function signUp(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed', // will match with 'password_confirmation'
        ]);

        if ($validator->fails() == True) {

            return response()->json([
                'status' => false,
                'Errors' => $validator->errors()->all()
            ], 401);
        } else {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user->save()) {

                $token =  $user->createToken('My Token')->plainTextToken;

                return response()->json(
                    [
                        'status' => true,
                        'Token' => $token,
                        'Message' => 'User SignUp Successfully !!',
                    ],
                    200
                );
            }
        }
    }

    // Login the User Api

    public function signIn(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails() == true) {

            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ],
                401
            );
        } else {

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {

                $token = $request->user()->createToken('My Token')->plainTextToken;

                return response()->json(
                    [
                        'message' => 'User SignIn Successfully !!',
                        'status' => true,
                        'Token' => $token
                    ],
                    200
                );
            } else {

                return response()->json(
                    [
                        'status' => false,
                        'Message' => 'Unauthorized user',
                    ],

                    401
                );
            }
        }
    }

    // Logout the User Api

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user && $user->currentAccessToken()) {

            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User logged Out successfully !!'
            ]);
        }
    }

    // forgetpassword the User Api

    public function forgetpassword(request $request)
    {


        $validator = Validator::make($request->all(), [

            'email' => 'required|email'
        ]);

        if ($validator->fails() == True) {

            return response()->json(['status' => true, 'Errors' => $validator->errors()->all()], 401);
        }

        $otp = rand(10000, 99999);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->OTP = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(1);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully!',
                'otp' => $otp
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not authorized.'
            ], 401);
        }
    }

    // Restpassword the User Api

    public function resetpassword(request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users,email',
            'otp'      => 'required',
            'password' => 'required|confirmed'

        ]);

        if ($validator->fails() == True) {
            return response()->json(
                [
                    'Status' => false,
                    'Errors' => $validator->errors()->all()
                ],
                401
            );
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 401);
        }

        // ✅ Check if OTP is expired
        if (Carbon::now()->gt(Carbon::parse($user->otp_expires_at))) {
            return response()->json([
                'status' => false,
                'message' => 'OTP has expired'
            ], 401);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password reset successfully'
        ]);
    }
}
