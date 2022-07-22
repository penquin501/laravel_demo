<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'created_at' => 'date:d M yy',
    ];

    //many to many
    public function products() {
        /**
         * ต้องการรู้ว่า user คนนั้นๆ มี product ในมือบ้าง
         */
        // return $this->belongsToMany(Product::class); //แบบไม่มี col อื่น เพิ่มเติม
        // return $this->belongsToMany(Product::class, 'carts', 'user_id', 'product_id'); //แบบระบุ table เช่นถ้า table 'carts' ไม่มี col ที่สร้างมาใหม่เอง
        return $this->belongsToMany(Product::class, 'carts', 'user_id', 'product_id')->withPivot(['qty'])->withTimestamps(); //แบบระบุ table เช่นถ้า table 'carts' มี col ที่สร้างมาใหม่เอง
    }
}
