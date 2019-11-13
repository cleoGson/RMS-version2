<?php

use Illuminate\Database\Seeder;
use App\Model\Grade;
class GradeTableSeeder extends Seeder
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
            ['name'=>'E',
            'display_name'=>'E'],
            ['name'=>'F',
            'display_name'=>'F'
            ] ,
            ['name'=>'S',
            'display_name'=>'S'
            ],
            ['name'=>'B+',
            'display_name'=>'B+'
            ] 
    ];
    Grade::insert($data);
    }
}
