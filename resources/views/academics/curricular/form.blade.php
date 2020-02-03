            {{ Form::inputText('name') }}
            {{ Form::inputSelect('semester_id',$semesters) }}
            {{ Form::inputSelect('year_id',$years) }}
            {{ Form::inputSelect2('subjects_id', $subjects,$selectedsubject) }}
            {{ Form::inputSelect2('optional_subjects', $subjects,$selected_optional_subject) }}