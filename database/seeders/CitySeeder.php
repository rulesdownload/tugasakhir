<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     City::truncate();
     City::create([   
             'Kecamatan' => 'Wanea',
             'Camat' => 'Mario Reivalino Rio Karundeng, S.STP'
                    ]);
     City::create([   
             'Kecamatan' => 'Wenang',
             'Camat' => 'Deysie Kalalo, SE MAP'
                    ]);
     City::create([   
             'Kecamatan' => 'Tuminting',
             'Camat' => 'Dany H. Kumajas, S.SOS'
                    ]);
     City::create([   
             'Kecamatan' => 'Tikala',
             'Camat' => 'Argo B Sangkay'
                    ]);
     City::create([   
             'Kecamatan' => 'Singkil',
             'Camat' => 'Zainal Naway, S.Sos'
                    ]);
    City::create([   
             'Kecamatan' => 'Sario',
             'Camat' => 'Handry Jouke Lasut, SE'
                    ]);
     City::create([   
             'Kecamatan' => 'Pall Dua',
             'Camat' => 'Glennstiano Kowaas, SH MH'
                    ]);
     City::create([   
             'Kecamatan' => 'Malalayang',
             'Camat' => 'Reintje Heidemans'
                    ]);
     City::create([   
             'Kecamatan' => 'Bunaken Kepulauan',
             'Camat' => 'Christian Salindeho'
                    ]);
     City::create([   
             'Kecamatan' => 'Bunaken',
             'Camat' => 'Drs. Boyke Pandean'
                    ]);
     City::create([   
             'Kecamatan' => 'Mapanget',
             'Camat' => 'Robert Dauhan S,STP'
                    ]);
    }
    
}
