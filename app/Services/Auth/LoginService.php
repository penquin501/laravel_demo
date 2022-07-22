<?php
namespace App\Service\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService 
{
    private $userData;

    public function __construct($userInfo)
    {
        $this->userData = $userInfo;
    }

    public function authRequest() {
        $authMethod = $this->checkAuthMethod();
        if($authMethod == 'mobile') {
            return $this->mobileLogin();
        } else {
            return $this->webLogin();
        }
    }

    private function checkAuthMethod()
    {
        if(isset($this->userData['device_name'])) {
            return 'mobile';
        } else {
            return 'web';
        }
    }

    private function mobileLogin() {
        $user = User::where('email', $this->userData['email'])->first();

        if (! $user || ! Hash::check($this->userData['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        
        $token = $user->createToken($this->userData['device_name'])->plainTextToken;
        return response()->json([
            'status' => 'success', 
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }

    private function webLogin() {
        $credentials =[
            'email' => $this->userData['email'], 
            'password' => $this->userData['password']
        ];
        if(!Auth::attempt($credentials)) {
            return response()->json(['status' => 'fail authen'], 401);
        }

        return response()->json(['status' => 'success'], 200);
    }
}
