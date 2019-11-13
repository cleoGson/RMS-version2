<?php

use Illuminate\Database\Seeder;
use App\Model\Section;
class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'section 1',
            'display_name'=>'section 1'],
            ['name'=>'section 2',
            'display_name'=>'section 2'],
            ['name'=>'section 3',
            'display_name'=>'section 3'
            ]
            
    ];
    Section::insert($data);
    }
}
