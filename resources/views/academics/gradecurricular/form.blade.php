            {{ Form::inputText('name') }}
            {{ Form::inputText('display_name') }}
            {{ Form::inputSelect('year_id', $academicYears) }}
            {{ Form::inputSelect2('grademarks_id', $gradeMarks,$selectedGrades) }}

           