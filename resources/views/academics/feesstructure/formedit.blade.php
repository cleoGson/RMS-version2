            {{ Form::inputText('name') }}
            {{ Form::inputTextArea('display_name') }}
             {{ Form::inputSelect('year_id', $academicYears) }}
            {{ Form::inputSelect2('feesamount_id', $feesAmount) }}
            {{ Form::inputSelect('status',[''=>'select status',1=>'Active',0=>'Deactivate']) }}