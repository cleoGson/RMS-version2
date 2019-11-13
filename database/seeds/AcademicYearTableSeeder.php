<?php

use Illuminate\Database\Seeder;
use App\Model\AcademicYear;

class AcademicYearTableSeeder extends Seeder
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
                 'name'=>'2019',
                 'start_date'=>date('2019-01-01 00:00:00'), 
                 'end_date'=>date('2019-12-31 00:00:00'), 
                  'status'=>'open',
                ],
               [
                'name'=>'2020',
                'start_date'=>date('2020-01-01 00:00:00'), 
                'end_date'=>date('2020-12-31 00:00:00'), 
                 'status'=>'pending',
                ],
                 [
                'name'=>'2021',
                'start_date'=>date('2021-01-01 00:00:00'), 
                'end_date'=>date('2021-12-31 00:00:00'), 
                    'status'=>'open',
                ],
                [
                'name'=>'2022',
                'start_date'=>date('2022-01-01 00:00:00'), 
                'end_date'=>date('2022-12-31 00:00:00'), 
                'status'=>'pending',
                ]  
    ];
    AcademicYear::insert($data);
    }
}
