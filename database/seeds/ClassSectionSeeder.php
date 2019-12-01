<?php

use Illuminate\Database\Seeder;
use App\Model\Classsection;
class ClassSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data=[
            ['name'=>'A',
            'display_name'=>'A'],
            ['name'=>'B',
            'display_name'=>'B'],
            ['name'=>'C',
            'display_name'=>'C'
            ],
            ['name'=>'D',
            'display_name'=>'D'],
            ['name'=>'E',
            'display_name'=>'E'
             ], 
            ['name'=>'F',
            'display_name'=>'F'
            ] ,
             ['name'=>'G',
            'display_name'=>'G'
             ], 
            ['name'=>'H',
            'display_name'=>'H'
            ] 
            
    ];
    Classsection::insert($data);
    }
}
