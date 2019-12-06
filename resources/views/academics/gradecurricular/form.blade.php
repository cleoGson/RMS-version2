            {{ Form::inputText('name') }}
            {{ Form::inputSelect('year_id', $academicYears) }}
            {{ Form::inputSelect2('grademarks_id', $gradeMarks,$selectedGrades) }}

           