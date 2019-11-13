<?php

use Illuminate\Database\Seeder;
use App\Model\Event;
class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Registration',
            'display_name'=>'Registration'],
            ['name'=>'School Opening first Semester',
            'display_name'=>'School Opening first Semester'],
            ['name'=>'School Opening second Semester',
            'display_name'=>'School Opening second Semester'
            ],
            ['name'=>'School closing first Semester',
            'display_name'=>'School closing first Semester'],
            ['name'=>'Test',
            'display_name'=>'Test'
            ]
    ];
    Event::insert($data);
    }
}
