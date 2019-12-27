            {{ Form::inputText('name') }}
            {{ Form::inputSelect('year_id', $academicYears) }}
            {{ Form::inputSelect2('gparange_id', $gparanges,$selectedGpa) }}

           