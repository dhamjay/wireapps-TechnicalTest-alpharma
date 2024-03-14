<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Medication;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 3; $i <= 3; $i++) {
        $newitem = new Medication();
        $newitem->name = 'a'.$i;
        $newitem->generic_name = 'A'.$i;
        $newitem->brand_name = 'AA'.$i;
        $newitem->description = "aaa".$i;
        $newitem->quantity = 100 + $i + 7;
        $newitem->expiry = '2025/12/31';
        $newitem->save();
        }
    }
}
