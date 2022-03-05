<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_read' => 'boolean'
    ];

    public function scopeRead($query)
    {
        return $query->where('is_read', 1);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }
}
