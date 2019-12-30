             {{ Form::inputText('student_id',$show->academicyearStudent->full_name,['readonly'=>'readonly']) }}
             {{ Form::inputText('classsection_id',$show->classsections->name,['readonly'=>'readonly']) }}
             {{ Form::inputText('semester_id',$show->semesters->name,['readonly'=>'readonly']) }}
             {{ Form::inputText('subject',$show->subjects->name,['readonly'=>'readonly']) }}
             {{ Form::inputText('examination_type',$show->examinationsType->name,['readonly'=>'readonly']) }}
             {{ Form::inputText('class_id',$show->classes->name,['readonly'=>'readonly'])}}
             {{ Form::inputText('year_id',$show->years->name,['readonly'=>'readonly'])}}
             {{ Form::inputText('marks') }}
             {{ Form::inputTextArea('remarks') }}