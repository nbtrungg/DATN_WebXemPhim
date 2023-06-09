<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function phimyeuthich()
    {
        return $this->belongsToMany(Phim::class, 'yeuthiches', 'user_id', 'phim_id');
    }

    public function phimlichsu()
    {
        return $this->belongsToMany(Phim::class, 'lichsuphims', 'user_id', 'phim_id');
    }

    public function user_theloai()
    {
        return $this->belongsToMany(Theloai::class,'user_theloai','user_id','theloai_id');
    }
}
