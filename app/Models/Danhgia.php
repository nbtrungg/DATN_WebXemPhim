<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhgia extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function phim()
    {
        return $this->belongsTo(Phim::class);
    }
}
