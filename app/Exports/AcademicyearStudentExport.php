<?php

namespace App\Exports;

use App\Model\AcademicyearStudent;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AcademicyearStudentExport implements FromArray,WithHeadings
{

  protected $students;

    public function __construct(array $students)
    {
        $this->students = $students;
    }

    public function array(): array
    {
        return $this->students;
    }

    public function headings(): array

    {

        return [
            'id',
            'firstname',
            'middlename',
            'lastname',
            'student_number',
            'marks',
            'remarks'
        ];

    }
}
