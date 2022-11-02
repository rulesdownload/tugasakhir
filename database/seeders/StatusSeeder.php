<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     status::truncate();
     status::create([   
             'parameter' => 'Belum dibaca'
        ]);
     status::create([   
             'parameter' => 'Telah dilihat'
                    ]);
     status::create([   
             'parameter' => 'Kasus akan diproses'
                    ]);
     status::create([   
             'parameter' => 'Kasus sementara diproses'
                    ]);
     status::create([
             'parameter' => 'Kasus tertangani'
                    ]);
    }
}
