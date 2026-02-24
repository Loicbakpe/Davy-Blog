<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'token', 'confirmed_at'];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    /**
     * Generate a unique unsubscribe token before creating.
     */
    protected static function booted(): void
    {
        static::creating(function ($subscriber) {
            $subscriber->token = Str::random(40);
        });
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed_at !== null;
    }
}
