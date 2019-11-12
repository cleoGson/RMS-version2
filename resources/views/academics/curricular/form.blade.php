            {{ Form::inputText('name') }}
            {{ Form::inputTextArea('display_name') }}
            {{ Form::inputSelect('semester_id',$semesters) }}
            {{ Form::inputSelect('year_id',$years) }}
            {{ Form::inputSelect2('subjects_id', $subjects) }}