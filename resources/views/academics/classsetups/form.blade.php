          
            {{ Form::inputText('name') }}
            {{ Form::inputSelect('class_id',$classes) }}
            {{ Form::inputText('minimum_capacity') }}
            {{ Form::inputText('maximum_capacity') }}
            {{ Form::inputSelect('grade_curricular',$grades) }}
            {{ Form::inputSelect2('subject_curricular',$curricular) }}
            {{ Form::inputSelect('fees_structure',$feesstructure) }}
            {{ Form::inputSelect2('examination_curricular',$examcurriculars) }}
            {{ Form::inputSelect('year_id',$years) }}
