<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //many to many
    public function users() {
        /**
         * ต้องการรู้ว่า product คนนั้นๆ มี user ไหนบ้าง
         */
        return $this->belongsToMany(User::class, 'carts', 'product_id', 'user_id')->withPivot(['qty'])->withTimestamps();
    }
}
