<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HotelProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
            $result = User::create(
                [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'created_by' => 1,
                    // 'type'=>'user',
                    'type' => 'free',
                    'email_token' => base64_encode($request['email']),
                ]
            );
            // $role=Role::findByName('user');
            $role = Role::findByName('free');
            if ($role) {
                $result->assignRole($role->id);
            }
            
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
                    $hotel = HotelProfile::where('user_id', $admin->id)->first('id');
                    $token = $admin->createToken('Login_token')->accessToken;
                    $admin['hotel_id'] = $hotel->id;
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
