<?php

namespace Database\Seeders;

use App\Models\Parte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Parte::factory()->count(300)->create();
    }
}
