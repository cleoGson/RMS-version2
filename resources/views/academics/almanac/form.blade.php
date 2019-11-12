           
           
        
            {{ Form::inputSelect('event_id',$events) }}
            {{ Form::inputTextArea('description') }}
            {{ Form::inputDateTime('start_date') }}
            {{ Form::inputTimepickerTwo('end_date') }}
            {{ Form::inputSelect('center_id',$centers) }}
            {{ Form::inputSelect('year_id',$years) }}
         