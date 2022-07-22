<?php

namespace App\Services\Category;

class DeleteService
{
    private $category;

    /**
     * Class constructor.
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    public function delete() {
        $this->category->delete();
        return response()->json(['status'=> 'success', 'deletedData' => null], 204);
    }
}
