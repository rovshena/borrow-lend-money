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
                'value' => 'Borrow Lend Money',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'description',
                'description' => 'Description',
                'value' => 'Borrow Lend Money',
                'type' => 'textarea',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'keyword',
                'description' => 'Keywords',
                'value' => 'borrow, lend, money, credit',
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
                'value' => 'borrowlend@money.com',
                'type' => 'text',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'about_us',
                'description' => 'About Us text',
                'value' => 'Borrow Lend Money',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'about_us_excerpt',
                'description' => 'Short extract from about us text',
                'value' => 'Borrow Lend Money',
                'type' => 'textarea',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'privacy_policy',
                'description' => 'Privacy Policy text',
                'value' => 'Privacy Policy',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'key' => 'terms_of_use',
                'description' => 'Terms of Use text',
                'value' => 'Terms of Use',
                'type' => 'editor',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
