<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    use HasFactory;
    protected $table = 'konfigurasis';
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = [];
}
