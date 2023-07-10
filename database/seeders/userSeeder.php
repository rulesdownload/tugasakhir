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
	     'avatar' =>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1XvTPCsBHENWNON35rXNL28Raq42XbkZynN1pdVBysrASNsXQ8tn5el68wGWIilnm5mE&usqp=CAU',
             'password' => bcrypt('admin'),
         ]);
    }
}
