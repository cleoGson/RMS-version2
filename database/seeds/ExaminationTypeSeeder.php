<?php

use Illuminate\Database\Seeder;
use App\Model\Examinationtype;
class ExaminationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           $data=[
            ['name'=>'Test One',
            'display_name'=>'T1'],
            ['name'=>'Test Two',
            'display_name'=>'T2'],
            ['name'=>'Group Work',
            'display_name'=>'G/W'
            ],
            ['name'=>'Test three',
            'display_name'=>'T3'],
            ['name'=>'Test Four',
            'display_name'=>'T4'
             ], 
            ['name'=>'Semister Examination',
            'display_name'=>'SE'
            ]   
    ];
    Examinationtype::insert($data);
    }
}
