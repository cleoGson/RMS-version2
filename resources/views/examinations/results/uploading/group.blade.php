           
             {{ Form::inputSelect('classsection_id', $classsections,null,['required'=>'required']) }}
             {{ Form::inputSelect('semester_id', $semesters,null,['required'=>'required']) }}
             {{ Form::inputSelect('subject',[],null,['required'=>'required']) }}
             {{ Form::inputSelect('examination_type',[],null,['required'=>'required']) }}
             {{ Form::inputFile('file')}}
             {{ Form::hidden('class_id',$class->id)}}
             {{ Form::hidden('classsetup_id',$classsetup->id )}}
             {{ Form::hidden('year_id',$years->id)}}