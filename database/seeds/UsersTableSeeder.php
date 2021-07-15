<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $user = \App\User::create([
            'name'    => 'Zee Store',
            'email'   => 'zee@app.com',
            'password'=> bcrypt('12345')
        ]);

        $user->attachRole('store');
        
    }
}
