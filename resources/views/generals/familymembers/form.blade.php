           
            {{ Form::inputText('firstname') }}
            {{ Form::inputText('middlename') }}
            {{ Form::inputText('lastname') }}
            {{ Form::inputSelect('sex',[''=>'select here','male'=>'Male','female'=>'Female']) }}
            {{ Form::inputText('phone_no') }}
            {{ Form::inputTextArea('address') }}
            {{ Form::inputDate('birth_date') }}
            {{ Form::inputSelect('disability',$disability) }}
            {{ Form::inputText('email') }}
            {{ Form::inputSelect('relationship', $relationship) }}
      
           