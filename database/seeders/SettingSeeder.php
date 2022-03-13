<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        DB::table('settings')->insert([
            [
                'key' => 'title',
                'description' => 'Title',
                'value' => 'Title',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'description',
                'description' => 'Description',
                'value' => 'Description',
                'type' => 'textarea',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'keyword',
                'description' => 'Keywords',
                'value' => 'keywords',
                'type' => 'textarea',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'author',
                'description' => 'Author',
                'value' => 'Author',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'address',
                'description' => 'Address',
                'value' => 'Address',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'phone',
                'description' => 'Phone',
                'value' => '+123 (45) 67-89-00',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'fax',
                'description' => 'Fax',
                'value' => '+123 (45) 67-89-00',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'email',
                'description' => 'E-mail',
                'value' => 'email@email.com',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'home_page_title',
                'description' => 'Заголовок главной страницы',
                'value' => 'Деньги срочно!',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'home_page_excerpt',
                'description' => 'Содержание домашней страницы',
                'value' => 'Приветствуем Вас на сайте доске объявлений, где каждый человек или же организация может взять или дать деньги в долг другому частному лицу или предприятию. Как правило, людям деньги требуются срочно и займы составляют от 500 гривен и, до нескольких сотен тысяч.',
                'type' => 'textarea',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'about_us',
                'description' => 'О нас текст',
                'value' => 'Приветствуем Вас на сайте доске объявлений, где каждый человек или же организация может взять или дать деньги в долг другому частному лицу или предприятию. Как правило, людям деньги требуются срочно и займы составляют от 500 гривен и, до нескольких сотен тысяч.',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'about_us_excerpt',
                'description' => 'Краткая выдержка из текста о нас',
                'value' => 'Приветствуем Вас на сайте доске объявлений, где каждый человек или же организация может взять или дать деньги в долг другому частному лицу или предприятию. Как правило, людям деньги требуются срочно и займы составляют от 500 гривен и, до нескольких сотен тысяч.',
                'type' => 'textarea',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'privacy_policy',
                'description' => 'Текст Политики конфиденциальности',
                'value' => 'Текст Политики конфиденциальности',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'terms_of_use',
                'description' => 'Текст условий использования',
                'value' => 'Текст условий использования',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'vk_link',
                'description' => 'Ссылка на ВКонтакте',
                'value' => null,
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'telegram_link',
                'description' => 'Ссылка на Telegram',
                'value' => null,
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'messenger_link',
                'description' => 'Ссылка на Messenger',
                'value' => null,
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'mail_to_email',
                'description' => 'Contact Form Mailer mail',
                'value' => null,
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
