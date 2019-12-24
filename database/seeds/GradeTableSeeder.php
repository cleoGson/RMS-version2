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
            'display_name'=>'A',
            'point'=>5,
            ],
            ['name'=>'B',
            'display_name'=>'B',
            'point'=>4,
            ],
            ['name'=>'C',
            'display_name'=>'C'
            ,
            'point'=>3,
            ],
            ['name'=>'E',
            'display_name'=>'E',
            'point'=>2,
            ],
            ['name'=>'F',
            'display_name'=>'F'
            ,
            'point'=>1,
            ],
            ['name'=>'S',
            'display_name'=>'S',
            'point'=>0.1,
            ],
            ['name'=>'B+',
            'display_name'=>'B+'
            ] ,
             ['name'=>'D',
            'display_name'=>'D',
            'point'=>0,
            ] 
    ];
    Grade::insert($data);
    }
}
