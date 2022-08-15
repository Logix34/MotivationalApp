<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = [
        'collection_name',
        'collection_type',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function quotes(){
        return $this->hasMany(Quote::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function likes()
    {
        return $this->hasManyThrough(Like::class, Quote::class);
    }

}
