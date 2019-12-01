            {{ Form::inputSelect('fees_id', $fees) }}
            {{ Form::inputText('amount') }}
            {{ Form::inputSelect('year_id', $academicYears) }}
            {{ Form::inputSelect('status',[''=>'select status',1=>'Active',0=>'Deactivate']) }}