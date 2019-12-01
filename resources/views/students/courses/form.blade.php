             <?php
             for($i=1;$i<=8; $i++){
              $duration[$i]=$i;
             }
             ?>
             {{ Form::inputSelect('level_id', $levels) }}
             {{ Form::inputSelect('department_id', $departments) }}
             {{ Form::inputSelect('duration',$duration) }}
             {{ Form::inputSelect('duration_unit', $durationunits) }}
              {{ Form::inputTextArea('description') }}
          