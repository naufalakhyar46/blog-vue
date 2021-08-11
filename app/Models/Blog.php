<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class,'id','id_user');
    }
}
