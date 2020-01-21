
            {{ Form::inputText('username',null,['readonly'=>'readonly']) }}
            {{ Form::inputText('email',null,['readonly'=>'readonly']) }}
            {{ Form::inputSelect2('roles',$roles,$rolesin) }}
  