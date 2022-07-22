<?php

namespace App\Models\Category;

use App\Models\Category;

class LoadService
{
    public function load() {
        $category = Category::orderBy('id', 'desc')->get();
        return response()->json(['status'=> 'success', 'data' => $category], 200);
    }
    
}
