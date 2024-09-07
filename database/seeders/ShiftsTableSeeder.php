<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;

class ShiftsTableSeeder extends Seeder
{
    public function run()
    {
        // Create 10 dummy shifts
        Shift::factory()->count(10)->create();
        
    }
}
