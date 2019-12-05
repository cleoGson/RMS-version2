            {{ Form::inputText('name') }}
            {{ Form::inputSelect('semester_id',$semesters) }}
            {{ Form::inputSelect('year_id',$years) }}
            {{ Form::inputSelect2('examinationmark_id', $exammarks,$selectedexammarks) }}