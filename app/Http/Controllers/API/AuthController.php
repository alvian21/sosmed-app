<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{

    public function user()
    {
        $user = Auth::user();
        $user = User::where('id',$user->id)->with('post')->first();
        $success['user'] =  $user;

        return $this->sendResponse($success, 'Data user retrived');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()->first()
            ];

            return response()->json($response, 400);
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'user register successfully'
            ];

            return response()->json($response, 200);
        }
    }

    public function login(Request $request)
    {

        $username = $request->get('username');

        $cek = User::where('username', $username)->orWhere('email', $username)->first();

        if ($cek) {

            if (Hash::check($request->get('password'), $cek->password)) {
                Auth::login($cek);
                $user = $request->user();
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['user'] =  $user;

                return $this->sendResponse($success, 'User signed in');
            }
        } else {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return $this->sendResponse([], 'User Logout');
    }
}
