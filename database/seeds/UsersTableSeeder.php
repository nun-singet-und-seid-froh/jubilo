<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('name','=','admin')->first()->id;

        $jonathan = new User;
            $jonathan['name'] = 'Jonathan Scholbach';
            $jonathan['email'] = 'j.scholbach@posteo.de';
            $jonathan['password'] = '$2a$04$FM34LLeYNGp9Vb2dtkZQD.aEHfI76QusEloMd5ILSiz/tIMnIiYCK';     
        $jonathan->save();
        $jonathan->roles()->attach($admin);
    }
}
