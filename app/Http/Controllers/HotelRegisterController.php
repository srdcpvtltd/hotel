<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HotelRegisterController extends Controller
{
    public function hotel_register(Request $request)
    {
        $payloads = $request->all();

        $validator = Validator::make($payloads, [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 200);
        } else {
            $result =User::create(
                [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password'])
                ]
            );;
            if ($result) {
                return response()->json([
                    'message' => "Hotel Registerd"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Register Failed"
                ], 200);
            }
        }
    }

    public function login(Request $request)
    {
        $payloads = $request->all();

        $validator = Validator::make($payloads, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 200);
        } else {
            $admin = User::where([
                'email' => $payloads['email']
            ])
                ->first();

            if (!$admin) {
                return response()->json([
                    'message' => 'Email is not found',
                    'code' => 500
                ], 200);
            } else {
                if ($admin && Hash::check($payloads['password'], $admin['password'])) {
                    $token = $admin->createToken('Login_token')->accessToken;
                    $admin['token'] = $token;
                    return response()->json([
                        'admin' => $admin
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Invalid Credentials'
                    ], 200);
                }
            }
        }
    }
}
