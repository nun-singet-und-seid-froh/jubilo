<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $editor = new Role;
            $editor['name'] = 'editor';
            $editor['slug'] = 'Redakteur*in';            
            $editor['description'] = 'role with the rights to add and change contents.';
        $editor->save();

        $admin = new Role;
            $admin['name'] = 'admin';
            $admin['slug'] = 'Admin';            
            $admin['description'] = 'role with maximum permissions, including assigning roles to other users';
        $admin->save();                    
    }
}
