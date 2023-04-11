<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapphim extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function phim(){
        return $this->belongsTo(Phim::class);
    }
}
