<?php

namespace Database\Seeders;

use App\Models\specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class specializationstableseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en'=> 'arabic', 'ar'=> 'عربي'],
            ['en'=> 'sciences', 'ar'=> 'علوم'],
            ['en'=> 'computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'english', 'ar'=> 'انجليزي'],
            ['en'=> 'social study', 'ar'=> 'دراسات اجتماعية'],

        ];
        foreach ($specializations as $S) {
            specialization::create(['name' => $S]);
        }
    }

}
