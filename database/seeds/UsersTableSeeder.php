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
            'email'   => 'zee_store@app.com',
            'password'=> \Hash::make('123456789')
        ]);

        $user->attachRole('store');
        
    }
}
