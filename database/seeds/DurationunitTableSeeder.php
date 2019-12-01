<?php

use Illuminate\Database\Seeder;
use App\Model\Durationunit;
class DurationunitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
              ['name' => 'Year',
            'range_from'=>12,
            'out_of'=>12,
             'created_at' => date('Y-m-d h:i:s'),
             'updated_at' => date('Y-m-d h:i:s')],

            ['name' => 'Month',
            'range_from'=>1,
            'out_of'=>12,
             'created_at' => date('Y-m-d h:i:s'),
             'updated_at' => date('Y-m-d h:i:s')
            ],
            [
             'name' => 'Quarter',
             'range_from'=>3,
             'out_of'=>12,
             'created_at' => date('Y-m-d h:i:s'),
             'updated_at' => date('Y-m-d h:i:s')
            ],
            ['name' => 'Week',
             'range_from'=>1,
             'out_of'=>52,
             'created_at' => date('Y-m-d h:i:s'),
             'updated_at' => date('Y-m-d h:i:s')
            ],

            ['name' => 'Day',
             'range_from'=>1,
             'out_of'=>365,
             'created_at' => date('Y-m-d h:i:s'),
             'updated_at' => date('Y-m-d h:i:s')
             ]
        ];
        Durationunit::insert($data);
    }
}
