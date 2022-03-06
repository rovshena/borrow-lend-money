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

    public function getTypeValueAttribute()
    {
        if ($this->type === self::TYPE_BORROW) {
            return 'Borrow Money';
        }

        return 'Lend Money';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', null);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
