<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(LaratrustSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(StudentstatusTableSeeder::class);
        $this->call(AcademicYearTableSeeder::class);
        $this->call(CenterTableSeeder::class);
        $this->call(ClassTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(DisabilityTableSeeder::class);
        $this->call(EducationLevelsTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(GradeTableSeeder::class);
        $this->call(MaritalTableSeeder::class);
        $this->call(SalaryScaleTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(SemesterTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(TermsofServiceTableSeeder::class); 
        $this->call(BloodgroupSeeder::class); 
         
    }
}
