<?php

namespace Database\Seeders;

use App\Models\blood_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class bloodtableseeder extends Seeder
{
    // 9:50 video 12
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // 11:08 video 12
    public function run()
    {
        DB::table('blood_types')->delete();
        $types = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
        foreach ($types as $type) {
            blood_type::create(['name' => $type]);
        }
    }
}
