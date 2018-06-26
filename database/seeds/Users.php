<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     'avatar' => 'image',
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
                	'name'=> 'Pratik Vanol',
                	'email' => 'pratik@local.com',
                	'password' => bcrypt('admin123'),
                    'isadmin' => 1
                ]);

        App\Profile::create([
            'user_id' => $user->id
        ]);

    }
}
