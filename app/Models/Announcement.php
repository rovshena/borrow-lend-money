<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
            return '<span class="badge bg-faded-success fs-sm me-2">Borrow</span>';
        }

        return '<span class="badge bg-faded-info fs-sm me-2">Lend</span>';
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->cyrillicToLatin($this->title));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function mainComments()
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

    public function cyrillicToLatin($value)
    {
        $cyrillic = ['а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'Є'];
        $latin = ['a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sh', '', 'y', '', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sh', '', 'Y', '', 'E', 'Yu', 'Ya', 'E'];
        return str_replace($cyrillic, $latin, $value);
    }
}
