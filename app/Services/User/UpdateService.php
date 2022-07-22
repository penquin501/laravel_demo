<?php
namespace App\Services\User;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class updateService 
{
    /* แบบปกติ */
    
    private $user;
    private $data;

    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function update() {
        $this->user->name = $this->data['name'];
        $this->user->save();

        // return response()->json([
        //     'status' => 'success'
        // ], 201);
    }
}