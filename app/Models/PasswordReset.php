<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';
    protected $fillable = ['email','token','created_at'];
    protected $dates = ['created_at'];
    protected $guarded = [];
    public $timestamps = false;
}
