<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marker;

class MarkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marker::truncate();
        Marker::create([   
                 'filename' => 'marker-putih.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-merah.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-pink.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-oranje.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-magenta.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-lime.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-lavender.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-kuning.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-krem.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-htam.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-hijau.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-cyan.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-coklat.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-birudongker.png'
                        ]);

        Marker::create([   
                 'filename' => 'marker-biru.png'
                        ]);

    }
}
