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
    public function tapphim(){
        return $this->hasMany(Tapphim::class);
    }
    public function danhgia(){
        return $this->hasMany(Danhgia::class);
    }
    public function tbdanhgia()
    {
        return $this->danhgia()->average('sao');
    }
    public function binhluan()
    {
        return $this->hasMany(Binhluan::class);
    }
    public function yeuthich(){
        return $this->hasMany(Yeuthich::class);
    }
    public function useryeuthich()
    {
        return $this->belongsToMany(User::class, 'yeuthiches', 'phim_id', 'user_id');
    }
}
