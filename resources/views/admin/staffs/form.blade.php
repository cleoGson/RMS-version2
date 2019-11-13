            {{ Form::inputText('firstname') }}
            {{ Form::inputText('middlename') }}
            {{ Form::inputText('lastname') }}
            {{ Form::inputSelect('sex',[''=>'Select','female'=>'Female','male'=>'Male']) }}
            {{ Form::inputDateTime('birth_date') }}
            {{ Form::inputSelect('marital_status',$maritals) }}
            {{ Form::inputSelect('disability',$disabilities) }}
            {{ Form::inputSelect('birth_country',$birthcountries) }}
            {{ Form::inputSelect('citzenship',$citizenship) }}
            {{ Form::inputSelect('department_id',$departments) }}
            {{ Form::inputSelect('designation_id',$designations) }}
            {{ Form::inputText('birth_place') }}
            {{ Form::inputText('email') }}
            {{ Form::inputText('phone_no') }}
            {{ Form::inputText('check_no') }}
            {{ Form::inputTextArea('address') }}

      
     