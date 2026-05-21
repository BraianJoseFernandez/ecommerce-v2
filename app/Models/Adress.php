<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'description',
        'city',
        'reference',
        'receiver',
        'receiver_info',
        'postal_code',
        'default',
    ];

    protected $casts = [
        'receiver_info' => 'array',
        'default'       => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
