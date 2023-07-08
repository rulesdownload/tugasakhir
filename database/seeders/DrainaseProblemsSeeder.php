<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\drainaseProblems;

class DrainaseProblemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     drainaseProblems::truncate();
     drainaseProblems::create([ 
             'problem' => 'empty',
             'marker_id'=> 1,
         ]);
     drainaseProblems::create([ 
             'problem' => 'Saluran penuh sampah',
             'marker_id'=> 2,
         ]);     
     drainaseProblems::create([ 
             'problem' => 'Saluran kurang dalam',
             'marker_id'=> 3,
         ]);
     drainaseProblems::create([ 
             'problem' => 'Saluran banyak lumpur atau tanah',
             'marker_id'=> 4,   
         ]);
     drainaseProblems::create([ 
             'problem' => 'Air disaluran keluar kejalan saat hujan',
             'marker_id'=> 5,             
         ]);
     drainaseProblems::create([ 
             'problem' => 'Saluran tak bisa dimasuki air dari jalan',
             'marker_id'=> 6,   
         ]);
     drainaseProblems::create([ 
             'problem' => 'Sisa penggalian belum diangkat',
             'marker_id'=> 7,   
         ]);
     drainaseProblems::create([ 
             'problem' => 'Trotoar tidak tertutup',
             'marker_id'=> 8,   
         ]);
     drainaseProblems::create([ 
             'problem' => 'Trotoar tidak tertutup dan penuh sampah',
             'marker_id'=> 9,   
         ]);
     drainaseProblems::create([ 
             'problem' => 'Trotoar tidak tertutup dan penuh lumpur',
             'marker_id'=> 10,   
         ]);
     drainaseProblems::create([ 
             'problem' => 'Trotoar berlubang-lubang',
             'marker_id'=> 11,
         ]);
    }
}
