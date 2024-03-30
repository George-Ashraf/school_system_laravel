<?php

namespace Database\Seeders;

use App\Models\blood_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // 15:50 video 12
    // seedهذا من اجل تنفيذ جميع ال
    public function run()
    {
        $this->call([
           specializationstableseed::class,
           SettingsTableSeeder::class

        ]);

    }
}
