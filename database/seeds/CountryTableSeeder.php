<?php

use Illuminate\Database\Seeder;
use App\Model\Country;
class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [ 
             'name'=>'Tanzania',
             'display_name'=>'Tz',
             'code'=>'255',
             'monetary'=>'Tanzania Shilings',
             'monetary_short_name'=>'TZS',
             'citizenship'=>'Tanzanian',
        ],
            
        [       
            'name'=>'Kenya',
            'display_name'=>'Tz',
            'code'=>'254',
            'monetary'=>'Kenya Shilings',
            'monetary_short_name'=>'KS',
            'citizenship'=>'Kenyan'
        ],       
    ];
    Country::insert($data);
    }
}
