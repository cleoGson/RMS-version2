<?php

use Illuminate\Database\Seeder;
use App\Model\Educationlevel;
class EducationLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Primary Certificate of Education',
            'display_name'=>'PCE'],
            [
            'name'=>'Certificate of Secondary Education',
            'display_name'=>'CSE'
            ],
            ['name'=>'Advanced Certificate of Secondary Education',
            'display_name'=>'ACSE'
            ],
            ['name'=>'Certificate',
            'display_name'=>'Certificate'],
            ['name'=>'Diploma',
            'display_name'=>'Diploma'
            ] ,
            ['name'=>'NTA level 4',
            'display_name'=>'NTA level 4'
            ],
            ['name'=>'NTA Level 6.',
            'display_name'=>'NTA Level 6.'
            ] ,
            ['name'=>'Advance Diploma',
            'display_name'=>'Advance Diploma',
            ] ,
            ['name'=>'Bachellor Degree',
            'display_name'=>'Bachellor',
            ] ,
            ['name'=>'Master Degree',
            'display_name'=>'Master',
            ] ,
            ['name'=>'Phd',
            'display_name'=>'Phd',
            ] 
    ];
    Educationlevel::insert($data);
    }
}
