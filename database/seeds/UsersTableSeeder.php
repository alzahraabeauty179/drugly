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
            'full_name'=> 'Mo Store',
            'email'    => 'mo@app.com',
            'password' => encrypt('12345')
        ]);

        $user->attachRole('store');
        
    }
}
