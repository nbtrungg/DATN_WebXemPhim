<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function danhmuc(){
        return $this->belongsTo(Danhmuc::class,'danhmuc_id');
    }
    public function theloai(){
        return $this->belongsTo(Theloai::class,'theloai_id');
    }
    public function quocgia(){
        return $this->belongsTo(Quocgia::class,'quocgia_id');
    }
}
