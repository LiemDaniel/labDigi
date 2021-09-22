<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Carbon\Carbon;
class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles  = Role::Select('id')->get();

        $user = new User();
        $user->name = 'Admin ICT BBI';
        $user->nik = 'admin';
        $user->factory_id = '1';
        $user->email = 'admin@super.co.id';
        $user->email_verified_at = carbon::now();
        $user->password =  bcrypt('Pass@123');
        $user->admin =  true;

        if($user->save()){
            $user->attachRoles($roles);   
        }
    }
}
