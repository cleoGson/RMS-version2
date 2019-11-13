<?php

use Illuminate\Database\Seeder;
use App\Model\Classroom;
class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Form One',
            'display_name'=>'Form One'],
            ['name'=>'Form Two',
            'display_name'=>'Form Two'],
            ['name'=>'Form Three',
            'display_name'=>'Form Three'
            ],
            ['name'=>'Form Four',
            'display_name'=>'Form Four'],
            ['name'=>'Form Five',
            'display_name'=>'Form Five'
             ], 
            ['name'=>'Form Six',
            'display_name'=>'Form Six'
            ] 
            
    ];
    Classroom::insert($data);
    }
}
