<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $superAdmin = \App\Role::create([
            'name'           => 'super_admin',
            'display_name'   => 'Super Admin',
            'description'    => 'The system administration.'
        ]);

        $store = \App\Role::create([
            'name'           => 'store',
            'display_name'   => 'Store',
            'description'    => 'Can do specific tasks like create categories, brand, products and receiving pharmacies orders.'
        ]);

        $pharmacy = \App\Role::create([
            'name'           => 'pharmacy',
            'display_name'   => 'Pharmacy',
            'description'    => 'Can do specific tasks like stagnant exchange and making orders.'
        ]);

    }
}
