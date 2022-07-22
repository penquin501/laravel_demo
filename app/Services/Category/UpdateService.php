<?php

namespace App\Services\Category;

class UpdateService
{
    private $data;
    private $category;

    /**
     * Class constructor.
     */
    public function __construct($data, $category)
    {
        $this->data = $data;
        $this->category = $category;
    }

    public function update() {
        $this->category->name = $this->data['name'];
        $this->category->save();
        return response()->json(['status'=> 'success', 'updatedData' => $this->category], 204);
    }
}
