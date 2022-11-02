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
             'tipe' => 'drainase primer'
         ]);
     drainaseTypes::create([
             'tipe' => 'drainase pinggir jalan'
         ]);
    }
}
