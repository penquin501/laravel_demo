<?php

namespace App\Services\Category;

// use App\Models\Category;

class ShowService
{
    private $data;
    
    /**
     * Class constructor.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function show() {
        return response()->json(['status'=> 'success', 'data' => $this->data], 200);
    }
}
