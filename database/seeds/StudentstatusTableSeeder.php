<?php

use Illuminate\Database\Seeder;
use App\Model\Studentstatus;

class StudentstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data=[
                ['name'=>'Continue',
                'display_name'=>'Continue'],
                ['name'=>'Complete',
                'display_name'=>'Complete'],
                ['name'=>'Postpone',
                'display_name'=>'Postpone'
                ],
                ['name'=>'Disqualify',
                'display_name'=>'Disqualify'],
                ['name'=>'Suspended',
                'display_name'=>'Suspended'
                ] 
        ];
            Studentstatus::insert($data);
        }
    }
