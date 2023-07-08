<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     User::truncate();
     User::create([ 
             'name' => 'admin',
             'level' => 'admin',
             'email' => 'admin@admin.com',
             'google_id' =>101,
	     'avatar' =>'https://images.app.goo.gl/j8CtKon2kEaz8gUM7',
             'password' => bcrypt('admin'),
         ]);
    }
}
