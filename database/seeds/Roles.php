<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::select('id')->get();
        $role = new Role();
        $role->name = 'ICT Admin';
        $role->display_name = 'ICT Admin';
        $role->description  = 'ICT Admin';

        
        if($role->save()){
            $role->attachPermissions($permissions);
        }
    }
}
