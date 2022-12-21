<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\drainaseTypes;

class DrainaseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     drainaseTypes::truncate();
     drainaseTypes::create([    
             'tipe' => 'empty'
         ]);
     drainaseTypes::create([    
             'tipe' => 'natural drainage'
         ]);
     drainaseTypes::create([
             'tipe' => 'artificial drainage'
         ]);
     drainaseTypes::create([
             'tipe' => 'Sub surface drainage'
         ]);
     drainaseTypes::create([
             'tipe' => 'Drainase Tersier'
         ]);
        drainaseTypes::create([
             'tipe' => 'Drainase Sekunder'
         ]);
        drainaseTypes::create([
             'tipe' => 'Drainase Primer'
         ]);
    }
}
