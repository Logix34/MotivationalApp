<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_important',
        'due_date',
        'user_id',
        'reminder_for',
        'reminder_at'
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }

    protected $casts = [
        'due_date' => 'datetime:d-m-y H:i:s',
        'reminder_at'  =>'datetime:d-m-y H:i:s',
    ];

}
