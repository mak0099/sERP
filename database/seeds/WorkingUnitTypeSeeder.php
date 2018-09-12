<?php

use Illuminate\Database\Seeder;

class WorkingUnitTypeSeeder extends Seeder{

    public function run(){
        
        $data=[
        	['name'=>'Central Depot'],
        	['name'=>'Depot'],
        	['name'=>'Warehouse'],
        ];

        \DB::table('working_unit_types')->insert($data);

    }
}
