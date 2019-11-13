<?php

use Illuminate\Database\Seeder;
use App\Model\TermsofService;

class TermsofServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Unspecified',
            'display_name'=>'Unspecified'],
            ['name'=>'Contract',
            'display_name'=>'Contract'],
            
    ];
    TermsofService::insert($data);
    }
}
