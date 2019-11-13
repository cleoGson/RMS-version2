<?php

use Illuminate\Database\Seeder;
use App\Model\Designation;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
    
        $data=[
            ['name'=>'Human Resource Officer',
            'display_name'=>'HR'],
            ['name'=>'Ict Officer',
            'display_name'=>'ICTO'],
            ['name'=>'Operation Clerk Officer',
            'display_name'=>'OPCO'
            ],
            ['name'=>'Accountant Officer',
            'display_name'=>'AO'],
            ['name'=>'Education Officer grade I',
            'display_name'=>'ED'
            ] 
            
    ];
    Designation::insert($data);
    }
}
