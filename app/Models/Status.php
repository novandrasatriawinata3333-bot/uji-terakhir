<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'updated_at_iot',
    ];

    protected $casts = [
        'updated_at_iot' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
