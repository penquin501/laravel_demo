<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\User\UpdateService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     *  Return the user that is logged in
     */
    public function getProfile(Request $request) {
        $userProfile = $request->user();
        return response()->json($userProfile, 200);
    }

    public function updateProfile(UpdateProfileRequest $request, User $user) {
        $updateUser = new UpdateService($user, $request->all());
        $updateUser->update();

        return response()->json(null, 204);
    }
}
