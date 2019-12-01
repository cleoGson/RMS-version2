<?php
use App\Model\Fees;
use Illuminate\Database\Seeder;

class SchoolFeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data=[
            ['name'=>'Tuition Fees',
            'display_name'=>'Tuition Fees'],
            ['name'=>'Accommodation',
            'display_name'=>'Accommodation'
            ],
            ['name'=>'Examination',
            'display_name'=>'Examination']
    ];
    Fees::insert($data);
    }
}
