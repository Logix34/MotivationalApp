<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'rating',
        'collection_id',

    ];
    public function collection(){
        return $this->belongsTo(Collection::class);
    }
}
