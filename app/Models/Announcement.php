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
            return '<span class="badge bg-faded-success fs-sm me-2">Возьму деньги в долг</span>';
        }

        return '<span class="badge bg-faded-info fs-sm me-2">Дам деньги в долг</span>';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function masterComments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', null);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
