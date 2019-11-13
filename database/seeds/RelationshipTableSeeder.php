<?php

use Illuminate\Database\Seeder;
use App\Model\FamilyRelationship;
class RelationshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Mother',
            'display_name'=>'Mother'],
            ['name'=>'Father',
            'display_name'=>'Father'],
            ['name'=>'Brother',
            'display_name'=>'Brother'
            ],
            ['name'=>'Sister',
            'display_name'=>'Sister'],
            ['name'=>'Spouse',
            'display_name'=>'Spouse'
            ] ,
            ['name'=>'Supervisor',
            'display_name'=>'Supervisor'
            ],
            ['name'=>'Manager',
            'display_name'=>'Manager'
            ] ,
            ['name'=>'Director',
            'display_name'=>'Director'
            ],
            ['name'=>'Teacher',
            'display_name'=>'Teacher'
            ],
            ['name'=>'Lecturer',
            'display_name'=>'Lecturer'
            ],
            ['name'=>'Friend',
            'display_name'=>'Friend'
            ],
    ];
    FamilyRelationship::insert($data);
    }
}
