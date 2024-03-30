<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 12:35 video 44
        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2023-2024'],
            ['key' => 'school_title', 'value' => 'MS'],
            ['key' => 'school_name', 'value' => 'Mora Soft International Schools'],
            ['key' => 'end_first_term', 'value' => '01-12-2023'],
            ['key' => 'end_second_term', 'value' => '01-03-2024'],
            ['key' => 'phone', 'value' => '01223226011'],
            ['key' => 'address', 'value' => 'القاهرة'],
            ['key' => 'school_email', 'value' => 'info@morasoft.com'],
            ['key' => 'logo', 'value' => '1.jpg'],
        ];

        DB::table('settings')->insert($data);
    }
}

