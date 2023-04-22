<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    use HasFactory;
    protected $dates = ['created_at'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function phim(){
        return $this->belongsTo(User::class);
    }
}
