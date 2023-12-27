<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Message extends Model
{
    use HasFactory;


    protected $fillable = [
        'from',
        'to',
        'content',
        'read',
        'read_at',
        'sent_at',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4();
        });
    }
}
