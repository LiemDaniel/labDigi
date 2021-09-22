<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Factory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('factory')->insert([
        	'factory_name'=>'F 1',
        	'address'=>'Indonesia Road no. 17',
        	'created_at'=>carbon::now()
        ]);
    }
}
