<?php

use Illuminate\Database\Seeder;
use App\Model\Subject;
class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Mathematics',
            'display_name'=>'Mth'],
            ['name'=>'Chemistry',
            'display_name'=>'Chm'],
            ['name'=>'Kiswahili',
            'display_name'=>'swhl'
            ],
            ['name'=>'English',
            'display_name'=>'Eng'],
            ['name'=>'Civics',
            'display_name'=>'Cvc'
            ] ,
            ['name'=>'History',
            'display_name'=>'Htry'
            ],
            ['name'=>'Physical Education.',
            'display_name'=>'PE'
            ] ,
            ['name'=>'Geography',
            'display_name'=>'Geog'
            ] 
    ];
    Subject::insert($data);
    }
}
