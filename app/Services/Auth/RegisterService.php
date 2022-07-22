<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterService 
{
    /* แบบปกติ */
    
    // private $userRequest;
    // public function __construct($newUserRequest)
    // {
    //     $this->userRequest = $newUserRequest;
    // }

    // public function save($request) {
    //     $user = new User();
    //     $user->name = $this->userRequest->name;
    //     $user->email = $this->userRequest->email;
    //     $user->password = Hash::make($this->userRequest->password);
    //     $user->save();
    // }

    /* แบบที่เรียกการใช้งานทันที */

    public function save(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 'success'
        ], 201);
    }
}