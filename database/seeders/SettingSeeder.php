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
                'description' => 'Содержание главной страницы',
                'value' => 'Приветствуем Вас на сайте доске объявлений, где каждый человек или же организация может взять или дать деньги в долг другому частному лицу или предприятию. Как правило, людям деньги требуются срочно и займы составляют от 500 гривен и, до нескольких сотен тысяч.',
                'type' => 'textarea',
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
                'key' => 'about_us',
                'description' => 'О нас текст',
                'value' => 'Приветствуем Вас на сайте доске объявлений, где каждый человек или же организация может взять или дать деньги в долг другому частному лицу или предприятию. Как правило, людям деньги требуются срочно и займы составляют от 500 гривен и, до нескольких сотен тысяч.',
                'type' => 'editor',
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
                'key' => 'credit_calculator',
                'description' => 'Страница кредитного калькулятора',
                'value' => 'Страница кредитного калькулятора',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'borrow_money_title',
                'description' => 'Название категории',
                'value' => 'Все объявления деньги в долг под расписку в Рубрике: Возьму деньги в долг',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'borrow_money_header_code',
                'description' => 'Код заголовка',
                'value' => '',
                'type' => 'code',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'borrow_money_footer_code',
                'description' => 'Код нижнего',
                'value' => '',
                'type' => 'code',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'lend_money_title',
                'description' => 'Название категории',
                'value' => 'Все объявления деньги в долг под расписку в Рубрике: Дам деньги в долг',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'lend_money_header_code',
                'description' => 'Код заголовка',
                'value' => '',
                'type' => 'code',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'lend_money_footer_code',
                'description' => 'Код нижнего',
                'value' => '',
                'type' => 'code',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'category_state_title',
                'description' => 'Название категории',
                'value' => 'Деньги в долг под расписку в {{country}} / {{state}}',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'category_state_content',
                'description' => 'Содержание категории',
                'value' => 'В этой рубрике вы можете увидеть объявления от частных лиц, которым срочно необходимо взять деньги в долг и инвесторов, которые готовы дать деньги в {{country}} / {{state}}.
                Чтобы срочно взять деньги в долг, оставьте объявление на странице: Взять деньги в {{country}} / {{state}}. Чаще всего быстро предоставят займ, если вы сможете оформить залог,
                например недвижимость или автомобиль. Если вы являетесь частным инвестором или сотрудником кредитной организации, вы можете оставить объявление о возможности выдачи займа на
                странице: Дать деньги в {{country}} / {{state}}. Посмотреть все объявления пользователей, которым необходимы деньги срочно в долг вы можете в рубрике: Взять деньги в долг.
                Посмотреть все предложения по срочным кредитам можно в рубрике: Дать деньги в долг. Внимание: Остерегайтесь мошенников!',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'category_state_header_code',
                'description' => 'Код заголовка',
                'value' => '',
                'type' => 'code',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'category_state_footer_code',
                'description' => 'Код нижнего',
                'value' => '',
                'type' => 'code',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'category_country_title',
                'description' => 'Название категории',
                'value' => 'Деньги в долг под расписку в {{country}}',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'category_country_content',
                'description' => 'Содержание категории',
                'value' => 'В этой рубрике вы можете увидеть объявления от частных лиц, которым срочно необходимо взять деньги в долг и инвесторов, которые готовы дать деньги в {{country}}.
                Чтобы срочно взять деньги в долг, оставьте объявление на странице: Взять деньги в {{country}}. Чаще всего быстро предоставят займ, если вы сможете оформить залог,
                например недвижимость или автомобиль. Если вы являетесь частным инвестором или сотрудником кредитной организации, вы можете оставить объявление о возможности выдачи займа на
                странице: Дать деньги в {{country}}. Посмотреть все объявления пользователей, которым необходимы деньги срочно в долг вы можете в рубрике: Взять деньги в долг.
                Посмотреть все предложения по срочным кредитам можно в рубрике: Дать деньги в долг. Внимание: Остерегайтесь мошенников!',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'category_country_header_code',
                'description' => 'Код заголовка',
                'value' => '',
                'type' => 'code',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'category_country_footer_code',
                'description' => 'Код нижнего',
                'value' => '',
                'type' => 'code',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
