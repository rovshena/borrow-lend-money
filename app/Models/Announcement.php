<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    const TYPE_BORROW = 1;
    const TYPE_LEND = 2;

    protected $guarded = ['id'];

    public function scopeBorrow($query)
    {
        return $query->where('type', self::TYPE_BORROW);
    }

    public function scopeLend($query)
    {
        return $query->where('type', self::TYPE_LEND);
    }
}
