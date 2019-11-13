<?php

use Illuminate\Database\Seeder;
use App\Model\SalaryScale;
class SalaryScaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'TPGS 1',
            'display_name'=>'TPGS 1'],
            ['name'=>'TPGS 2',
            'display_name'=>'TPGS 2'],
            ['name'=>'TPGS 3',
            'display_name'=>'TPGS 3'
            ],
            ['name'=>'TPGS 4',
            'display_name'=>'TPGS 4'],
            ['name'=>'TPGS 5',
            'display_name'=>'TPGS 5'
            ] ,
            ['name'=>'TPGS 6',
            'display_name'=>'TPGS 6'
            ],
            ['name'=>'TPSS 1',
            'display_name'=>'TPSS 1'
            ] ,
            ['name'=>'TPSS 2',
            'display_name'=>'TPSS 2'
            ] 
    ];
    SalaryScale::insert($data);
    }
}
