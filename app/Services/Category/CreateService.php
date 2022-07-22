<?php

namespace App\Services\Category;

use App\Models\Category;

class CreateCategory 
{ 
    private $data;
    
    /**
     * Class constructor.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function save() {
        $category = new Category();
        $insertedData = $category->create($this->data);

        return response()->json(['status'=> 'success', 'insertedData' => $insertedData], 201);
    }
}
