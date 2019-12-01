<?php

use Illuminate\Database\Seeder;
use App\Model\Level;
class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data=[
            ['name'=>'Certificate of primary education (CPE)',
            'display_name'=>'Certificate of primary education (CPE)'],
            ['name'=>'Certificate of Secondary Education (CSE)',
            'display_name'=>'Certificate of Secondary Education (CSE)'],
            ['name'=>'Advance certificate of Secondary Education (ACSE)',
            'display_name'=>'Advance certificate of Secondary Education (ACSE)'
            ],
            ['name'=>'NTA LEVEL 01',
            'display_name'=>'NTA LEVEL 01'],
            ['name'=>'NTA Level 2',
            'display_name'=>'NTA Level 2'
            ],
            ['name'=>'NTA Level 3',
            'display_name'=>'NTA Level 3'],
            ['name'=>'NTA level 4',
            'display_name'=>'NTA level 4'
            ] ,
            ['name'=>'NTA level 5',
            'display_name'=>'NTA level 5'
            ],
            ['name'=>'NTA level 6',
            'display_name'=>'NTA level 6'
            ] ,
            ['name'=>'Diploma',
            'display_name'=>'Diploma'
            ],
            ['name'=>'Advance Diploma',
            'display_name'=>'Advance Diploma'
            ],
            ['name'=>'Bachelor Degree',
            'display_name'=>'Bachelor Degree'
            ],  
    ];
    Level::insert($data);
    }

}
