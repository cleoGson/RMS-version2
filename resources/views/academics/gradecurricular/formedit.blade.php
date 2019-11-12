            {{ Form::inputText('name') }}
            {{ Form::inputTextArea('display_name') }}
            {{ Form::inputSelect('year_id',$academicYears) }}
            {{ Form::inputSelect2('grademarks_id', $gradeMarks) }}
            {{ Form::inputSelect('status',[''=>'select status',1=>'Active',0=>'Deactivate']) }}