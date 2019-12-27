          
            {{ Form::inputText('name') }}
            {{ Form::inputSelect('class_id',$classes) }}
            {{ Form::inputText('minimum_capacity') }}
            {{ Form::inputText('maximum_capacity') }}
            {{ Form::inputSelect('grade_curricular',$grades) }}
            {{ Form::inputSelect2('subject_curricular',$curricular,$selectedsubjectcurr) }}
            {{ Form::inputSelect('fees_structure',$feesstructure) }}
            {{ Form::inputSelect('gpa_curricular',$gpa_curricular) }}
            {{ Form::inputSelect('result_system',[1=>'Percentage',0=>'Non Percentage'])  }}
             {{ Form::inputSelect('gpa_applicable',[1=>'Yes',0=>'No'])  }}
            {{ Form::inputSelect2('examination_curricular',$examcurriculars,$selectedexamcurr) }}
            {{ Form::inputSelect('year_id',$years) }}

            