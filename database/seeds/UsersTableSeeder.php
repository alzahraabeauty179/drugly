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
            'email'    => 'mo_store@app.com',
            'password' => \Hash::make('123456789')
        ]);

        $user->attachRole('store');
        
    }
}
