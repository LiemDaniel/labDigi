<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'menu-dashboard',
                'display_name' => 'Menu Dashboard',
                'description' => 'Menu Dashboard'
            ],
            [
                'name' => 'menu-user-management',
                'display_name' => 'Menu User Management',
                'description' => 'Menu User Management'
            ]
            
        ];

        foreach ($permissions as $key => $permission) {
            Permission::create([
                'name' => $permission['name'],
                'display_name' => $permission['display_name'],
                'description' => $permission['description']
            ]);
        }
    }
}
