<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_name',
        'category_id',
        'subcategory_id',
        'collection_id',
        'quote',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
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
    public function unfavorites(){
        return $this->hasMany(UnFavorite::class);
    }
    public function collection(){
        return $this->belongsTo(Collection::class);
    }
}
