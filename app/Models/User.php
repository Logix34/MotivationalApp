<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'first_name',
        'last_name',
        'profile_image',
        'user_type',
        'lang',
        'status',
        'theme_id',
        'email',
        'password',
    ];
    public function theme(){
        return $this->belongsTo(Theme::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function dislikes(){
        return $this->hasMany(Dislike::class);
    }
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
    public function reminders(){
        return $this->hasMany(Reminder::class);
    }
    public function collections(){
        return $this->hasMany(Collection::class);
    }
    public function unfavorites(){
        return $this->hasMany(UnFavorite::class);
    }

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
        'created_at'  =>'datetime:d-m-y H:i:s',
    ];
}
