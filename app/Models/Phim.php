<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Phim extends Model
{
    public $timestamps=false;
    use SearchableTrait;
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
    public function userlichsu()
    {
        return $this->belongsToMany(User::class, 'lichsuphims', 'phim_id', 'user_id');
    }
    public function phim_theloai()
    {
        return $this->belongsToMany(Theloai::class,'phim_theloai','phim_id','theloai_id');
    }
    protected $searchable = [
        'columns' => [
            'phims.tieude' => 50,
            'phims.mota' => 10,
            'phims.namphim' => 5,
        ],
    ];
}
