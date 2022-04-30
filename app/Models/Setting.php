<?php

namespace App\Models;

use App\Traits\HasStatusAttribute;
use App\Traits\HasStatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasStatusAttribute, HasStatusScope;

    protected $guarded = ['id'];

    const PAGES = [
        0 => [
            'id' => 1,
            'key' => 'home_page',
            'name' => 'Главная страница'
        ],
        1 => [
            'id' => 2,
            'key' => 'about_us',
            'name' => 'О нас'
        ],
        2 => [
            'id' => 3,
            'key' => 'privacy_policy',
            'name' => 'Политика конфиденциальности'
        ],
        3 => [
            'id' => 4,
            'key' => 'terms_of_use',
            'name' => 'Условия использования'
        ],
        4 => [
            'id' => 5,
            'key' => 'credit_calculator',
            'name' => 'Кредит калькулятор'
        ],
        5 => [
            'id' => 6,
            'key' => 'borrow_money',
            'name' => 'Категории «Возьму деньги в долг»'
        ],
        6 => [
            'id' => 7,
            'key' => 'lend_money',
            'name' => 'Категории «Дам деньги в долг»'
        ],
        7 => [
            'id' => 8,
            'key' => 'category_country',
            'name' => 'Категории «Деньги в страна»'
        ],
        8 => [
            'id' => 9,
            'key' => 'category_city',
            'name' => 'Категории «Деньги в городах»'
        ],
        9 => [
            'id' => 10,
            'key' => 'announcement',
            'name' => 'Страница объявлений'
        ],
        10 => [
            'id' => 11,
            'key' => 'contact_us',
            'name' => 'Связаться с нами'
        ],
        11 => [
            'id' => 12,
            'key' => 'lend_money_form',
            'name' => 'Форм: Дать займ'
        ],
        12 => [
            'id' => 13,
            'key' => 'borrow_money_form',
            'name' => 'Форм: Взять займ'
        ],
    ];
}
