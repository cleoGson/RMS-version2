          
            {{ Form::inputText('name') }}
            {{ Form::inputSelect('class_id',$classes) }}
            {{ Form::inputText('minimum_capacity') }}
            {{ Form::inputText('maximum_capacity') }}
            {{ Form::inputSelect('classsection_id',$classsections) }}
            {{ Form::inputSelect('grade_curricular',$grades) }}
            {{ Form::inputSelect('curricular_id',$curricular) }}
             {{ Form::inputSelect('feesstructure_id',$feesstructure) }}
            {{ Form::inputSelect('year_id',$years) }}
