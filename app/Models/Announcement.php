<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Announcement extends Model
{
    use HasFactory, Sluggable, Searchable;

    const TYPE_BORROW = 1;
    const TYPE_LEND = 2;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::created(function ($announcement) {
            if (!app()->runningInConsole()) {
                $country = Country::find($announcement->country_id);
                $state = State::find($announcement->state_id);
                $announcement->update([
                    'country_name'=> $country->name,
                    'state_name' => $state->name
                ]);
            }
        });
    }

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

    public function getSlugAttribute()
    {
        return $this->slug($this->title);
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

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
