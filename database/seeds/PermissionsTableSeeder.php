<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $showBrands = \App\Permission::create([
            'name'           => 'show_brands',
            'display_name'   => 'Show Brands',
            'description'    => 'Show all brands index page'
        ]);

        $createBrand = \App\Permission::create([
            'name'         => 'create_brand',
            'display_name' => 'Create Brand', 
            'description'  => 'Create new brands', 
        ]);
        
        $editBrand = \App\Permission::create([
            'name'         => 'edit_brand',
            'display_name' => 'Edit Brand', 
            'description'  => 'Edit existing brands', 
        ]);

        $deleteBrand = \App\Permission::create([
            'name'         => 'delete_brand',
            'display_name' => 'Delete Brand', 
            'description'  => 'Delete existing brands', 
        ]);

        $showCategories = \App\Permission::create([
            'name'           => 'show_categories',
            'display_name'   => 'Show Categories',
            'description'    => 'Show all categories index page'
        ]);

        $createCategory = \App\Permission::create([
            'name'         => 'create_category',
            'display_name' => 'Create Category', 
            'description'  => 'Create new categories/sub-categories', 
        ]);
        
        $editCategory = \App\Permission::create([
            'name'         => 'edit_category',
            'display_name' => 'Edit Category', 
            'description'  => 'Edit existing categories/sub-categories', 
        ]);

        $deleteCategory = \App\Permission::create([
            'name'         => 'delete_category',
            'display_name' => 'Delete Category',
            'description'  => 'Delete existing categories/sub-categories',
        ]);
    }
}
