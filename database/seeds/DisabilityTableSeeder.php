<?php

use Illuminate\Database\Seeder;
use App\Model\Disability;
class DisabilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
        $data=[
            ['name'=>'Vision Impairment',
            'display_name'=>'Vision Impairment'],
            ['name'=>'Deaf or hard of hearing',
            'display_name'=>'Deaf or hard of hearing'],
            ['name'=>'Mental health conditions',
            'display_name'=>'Mental health conditions'
            ],
            ['name'=>'Intellectual disability',
            'display_name'=>'Intellectual disability'],
            ['name'=>'Acquired brain injury',
            'display_name'=>'Acquired brain injury'
            ] ,
            ['name'=>'Autism spectrum disorder.',
            'display_name'=>'Autism spectrum disorder.'
            ],
            ['name'=>'Physical disability.',
            'display_name'=>'Physical disability.'
            ] ,
            ['name'=>'None',
            'display_name'=>'None'
            ] 
    ];
    Disability::insert($data);
    }
}
