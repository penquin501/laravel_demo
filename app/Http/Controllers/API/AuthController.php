<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Service\Auth\LoginService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $registerUser;

    public function __construct(RegisterService $registerService)
    {
        $this->registerUser = $registerService;
        $this->middleware('auth:sanctum')->only('logout');
    }

    public function register(RegisterRequest $request) {

        /* ทั่วไป */
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();

        /* เรียกใช้ service */
        // $registerUser = new RegisterService($request);
        // $registerUser->save();

        /* เรียกใช้ service แบบไม่ต้องใช้ new service*/
        return $this->registerUser->save($request);

        // return response()->json([
        //     'status' => 'success'
        // ], 201);
    }

    public function login(LoginRequest $request) {
        /* แบบเรียก Request เดิมๆ (Request $request) */

        // $loginUser = new LoginService($request->all());
        // return $loginUser->authRequest();

        /* แบบเรียก Request ของเราเอง */

        $loginUser = new LoginService($request->all());
        return $loginUser->authRequest();
    }

    /**
     * Log out user
     */
    public function logout(Request $request) {
        if(isset($request->device_name)) {
            $request->user()->currentAccessToken()->delete();
        } else {
            // web
            Auth::logout();
        }

        return response()->json(['status'=>'logged out'], 200);
    }
}
