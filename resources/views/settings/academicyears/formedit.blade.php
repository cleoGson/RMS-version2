            {{ Form::inputText('name') }}
            {{ Form::inputDateTime('start_date') }}
            {{ Form::inputTimepickerTwo('end_date') }}
            {{ Form::inputSelect('status',['Open'=>'Open','Pending'=>'Pending','Closed','Closed'])}}
         