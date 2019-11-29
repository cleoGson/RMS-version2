           
            {{ Form::inputText('firstname') }}
            {{ Form::inputText('middlename') }}
            {{ Form::inputText('lastname') }}
            {{ Form::inputSelect('sex',[''=>'select here','male'=>'Male','female'=>'Female']) }}
            {{ Form::inputText('phone_no') }}
            {{ Form::inputTextArea('address') }}
            {{ Form::inputDate('birth_date') }}
            {{ Form::inputSelect('disability',$disability) }}
            {{ Form::inputSelect('blood_group',$bloodgroups) }}
            {{ Form::inputText('birth_place') }}
            {{ Form::inputSelect('birth_country', $birthcountries) }}
            {{ Form::inputSelect('citzenship', $citizenship) }}