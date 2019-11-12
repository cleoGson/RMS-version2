            {{ Form::inputText('name') }}
            {{ Form::inputText('display_name') }}
            {{ Form::inputSelect('grade_id',$grades) }}
            {{ Form::inputText('minimum_marks') }}
            {{ Form::inputText('maximum_marks') }}
            {{ Form::inputText('grade_point') }}