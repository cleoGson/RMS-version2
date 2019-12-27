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
            'remarks'=>'Excellent',    
            ],
            ['name'=>'B',
            'display_name'=>'B',
            'point'=>4,
            'remarks'=>'Very Good',    
             ],
            ['name'=>'C',
            'display_name'=>'C'
            ,
            'point'=>3,
            'remarks'=>'Average',    
             ],
            ['name'=>'E',
            'display_name'=>'E',
            'point'=>2,
            'remarks'=>'',    
             ],
            ['name'=>'F',
            'display_name'=>'F'
            ,
            'point'=>1,
            'remarks'=>'Fail',    
             ],
            ['name'=>'S',
            'display_name'=>'S',
            'point'=>0.1,
            'remarks'=>'',    
             ],
            ['name'=>'B+',
            'display_name'=>'B+',
             'point'=>0.2,
             'remarks'=>'Good',   
            ] ,
             ['name'=>'D',
            'display_name'=>'D',
            'point'=>0.1,
            'remarks'=>'Marginal Fail',   
            ] 
    ];
    Grade::insert($data);
    }
}
